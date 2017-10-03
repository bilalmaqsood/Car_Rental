<?php

namespace Qwikkar\Concerns;

use Carbon\Carbon;
use Qwikkar\Models\User;
use Qwikkar\Models\Vehicle;
use Qwikkar\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\BookingLog;
use Qwikkar\Models\BookingPayment;
use Qwikkar\Models\BookingContract;
use Qwikkar\Events\BookingUnsuccessfull;
use Qwikkar\Notifications\BookingNotify;
use Qwikkar\Notifications\BookingPaymentNotify;


trait BookingOperations
{
    /**
     * Generate list of dates between two dates
     *
     * @param $start
     * @param $end
     * @return array
     */
    protected function generateDateRange($start, $end)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $dates = [];

        for ($date = $start; $date->lte($end); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    /**
     * Change status of time slots
     *
     * @param Vehicle $vehicle
     * @param int $status
     */
    protected function changeSlotsStatus(Vehicle $vehicle,$booking_id=null, $status = 1)
    {
        $vehicle->timeSlots->each(function ($ts) use ($status, $booking_id) {
            $ts->status = $status;
            $ts->booking_id = $booking_id;
            $ts->save();
        });
    }

    /**
     * Start the booking of provided Vehicle
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function proceedToBooking(Request $request, Vehicle $vehicle)
    {
        // validate if booking already exists
        if (
        $vehicle->booking()
            ->where('start_date', Carbon::parse($request->start_date))
            ->where('end_date', Carbon::parse($request->end_date))
            ->whereNotIn('status', [3, 4, 7,6])
            ->count()
        )
            return api_response(trans('booking.exist', ['vehicle' => $vehicle->vehicle_name]), Response::HTTP_CONFLICT);        

        $booking = new Booking($request->all());

        $booking->deposit = $vehicle->deposit;

        $booking->vehicle()->associate($vehicle);
        $booking->user()->associate($request->user());
        $booking->status = BOOKING_REQUESTED;
        $booking->save();

        $log = new BookingLog();
        $log->requested_note = "Booking requested";
        $log->requested_data = ["status" => BOOKING_ACCEPTED];
        $log->requested_time = Carbon::now();
        $log->requested()->associate($request->user());
        $booking->bookingLog()->save($log);
        
        $this->changeSlotsStatus($vehicle,$booking->id, 2);

        Couponize::processPromoCode($booking, $request);

        // $this->deductDeposit($booking, $request->user()); deduct after booking accepted

        // $this->generateContract($booking); generate after booking accepted

        $booking->vehicle->owner->user->notify(new BookingNotify([
            'id' => $booking->id,
            'type' => 'Booking',
            'status' => $booking->status,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
            'title' => 'Booking requested',
            'user' => $request->user()->name,
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
        ]));

        return api_response($booking->fresh(['vehicle' => function ($with) {
            $with->select('id', 'make', 'model', 'variant', 'year', 'deposit', 'images');
        }]));
    }

    /**
     * Deduct deposit from driver's account
     *
     * @param Booking $booking
     * @param User $user
     */
    protected function deductDeposit(Booking $booking, User $user)
    {
        if ($user->current_balance < $booking->deposit)
            $account = $this->makePaymentFromCard($user, $booking->deposit);
        else
            $account = $user->creditCard()->where('default', 1)->first();

        // deduct deposit from balance
        $user->balance->current -= $booking->deposit;
        $user->balance->save();

        // add booking payment log
        $payment = new BookingPayment([
            'title' => 'Deposit',
            'cost' => $booking->deposit,
            'due_date' => $booking->start_date,
            'paid' => 1,
        ]);
        $booking->payments()->save($payment);

        // notify driver for deposit deduction
        $user->notify(new BookingPaymentNotify([
            'id' => $payment->id,
            'view_type' => '',
            'title' => 'Booking request deposit',
            'user' => $user->name,
            'vehicle' => $booking->vehicle->vehicle_name,
            'deposit' => $booking->deposit,
            'status'  => 100,
        ]));

        // update booking status for confirmed to requested
        $booking->account()->associate($account);
        $booking->status = 1;
        $booking->save();

        // add first week rent
        $rent = $booking->vehicle->rent;
        if (count($booking->vehicle->discounts))
            foreach ($booking->vehicle->discounts as $discount) {
                if ($discount['week'] == 1)
                    $rent -= (100 + $discount['percent']) / 100;
            }
        $booking->payments()->create([
            'title' => 'Week 1',
            'cost' => $rent,
            'due_date' => $booking->start_date->addWeek()
        ]);

        // add log of balance of deposit deduction
        $balanceLog = new BalanceLog([
            'amount' => $booking->deposit,
            'comment' => 'deduct payment for booking deposit',
        ]);
        $balanceLog->balance()->associate($user->balance);
        $payment->balanceLogs()->save($balanceLog);

        $booking->vehicle->owner->user->notify(new BookingNotify([
            'id' => $booking->id,
            'type' => 'Booking',
            'status' => $booking->status,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
            'title' => 'Booking requested',
            'user' => $user->name,
            'credit_card' => $account->last_numbers,
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
            'deposit' => $booking->deposit,
            'signatures' => [
                'owner' => $booking->signatures && $booking->signatures->has('owner'),
                'client' => $booking->signatures && $booking->signatures->has('client')
            ]
        ]));
    }

    /**
     * Generate booking contract for driver
     *
     * @param Booking $booking
     */
    protected function generateContract(Booking $booking)
    {
        $dataPlaced = $this->compileTemplate($booking);

        $fileName = '/document/' . md5($booking->vehicle->vehicle_name . '-' . $booking->id) . '.pdf';

        \PDF::loadView('pdf.contract', [
            'content' => $dataPlaced
        ])->save(storage_path('app/public' . $fileName));

        $fileName = '/storage' . $fileName;

        $booking->documents = collect([['name' => 'Booking Contract', 'type' => 'pdf', 'path' => $fileName]]);
        $booking->save();
    }

    /**
     * Compile template of contract
     *
     * @param Booking $booking
     * @return mixed
     */
    protected function compileTemplate(Booking $booking)
    {
        $compiledString = \Blade::compileString($booking->vehicle->contractTemplate->template);
        
        $dataPlaced = render($compiledString, [
            'owner_company' => $booking->vehicle->owner->company ?: '',
            'owner_name' => $booking->vehicle->owner->user->name ?: '',
            'owner_email' => $booking->vehicle->owner->user->email ?: '',
            'owner_contact_number' => $booking->vehicle->owner->user->phone ?: '',
            'driver_name' => $booking->user->name ?: '',
            'driver_email' => $booking->user->email ?: '',
            'driver_contact_number' => $booking->user->phone ?: '',
            'vehicle_registration' => $booking->vehicle->registration_number ?: '',
            'contract_start_date' => $booking->start_date->format('l jS \\of F Y'),
            'contract_end_date' => $booking->end_date->format('l jS \\of F Y'),
        ]);

        $dataPlaced = trim($dataPlaced, "\"");
        $dataPlaced = trim($dataPlaced);

        $dataPlaced = str_replace('\n', '<br>', $dataPlaced);

        return str_replace("\n", '<br>', $dataPlaced);
    }

    /**
     * Sign the contract according to user type
     *
     * @param Request $request
     * @param Booking $booking
     */
    protected function signContract(Request $request, Booking $booking)
    {
        $dataPlaced = $this->compileTemplate($booking);

        $fileName = '/document/' . md5($booking->vehicle->vehicle_name . '-' . $booking->id) . '.pdf';

        $pdfData = ['content' => $dataPlaced];

        $signatures = $booking->signatures;

        if ($signatures)
            $signatures->put($request->user()->types->first()->name, $request->signature->store('images', 'public'));
        else
            $signatures = collect([
                $request->user()->types->first()->name => $request->signature->store('images', 'public')
            ]);

        $oldStatus = $booking->status;

        if ($signatures->has('client')) {
            $booking->status = 2;
            $pdfData['driver_signature'] = $signatures->get('client');
        }

        if ($signatures->has('owner')) {
            $booking->status = 3;
            $pdfData['owner_signature'] = $signatures->get('owner');
        }

//        if ($signatures->has('owner') && $signatures->has('client')) $booking->status = 4;

        $booking->signatures = $signatures;
        $booking->save();

        if ($request->user()->isOwner())
            $booking->user->notify(new BookingNotify([
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => $booking->status,
                'old_status' => $oldStatus,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Booking signature\'s by owner',
                'user' => $request->user()->name,
                'credit_card' => $booking->account ? $booking->account->last_numbers : '',
                'vehicle' => $booking->vehicle->vehicle_name ?: '',
                'contract_start' => $booking->start_date,
                'contract_end' => $booking->end_date,
                'deposit' => $booking->deposit,
                'signatures' => [
                    'owner' => $booking->signatures && $booking->signatures->has('owner'),
                    'client' => $booking->signatures && $booking->signatures->has('client')
                ]
            ]));
        else if ($request->user()->isClient()){
            $this->inspectionNotifyDriver($booking);
            $booking->vehicle->owner->user->notify(new BookingNotify([
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => $booking->status,
                'old_status' => $oldStatus,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Booking signature\'s by client',
                'user' => $request->user()->name,
                'credit_card' => $booking->account?$booking->account->last_numbers:'',
                'vehicle' => $booking->vehicle->vehicle_name,
                'contract_start' => $booking->start_date,
                'contract_end' => $booking->end_date,
                'deposit' => $booking->deposit,
                'signatures' => [
                    'owner' => $booking->signatures && $booking->signatures->has('owner'),
                    'client' => $booking->signatures && $booking->signatures->has('client')
                ]
            ]));
        }

        \PDF::loadView('pdf.contract', $pdfData)->save(storage_path('app/public' . $fileName));
    }

    /**
     * Make a payment from default credit card
     *
     * @param User $user
     * @param float $amount
     */
    protected function makePaymentFromCard(User $user, $amount)
    {
        if (!$user->balance) {
            $user->balance()->create(['current' => 0]);
            $user->load('balance');
        }

        return $user->addBalance($amount);
    }

    /**
     * Validate booking according to user type
     *
     * @param Booking $booking
     * @param Request $request
     * @return bool
     */
    protected function validateBooking(Booking $booking, Request $request)
    {
        return (
            ($request->user()->isOwner() && $request->user()->id !== $booking->vehicle->owner->user->id) ||
            ($request->user()->isClient() && $request->user()->id !== $booking->user->id)
        );
    }

    /**
     * Update a booking with slots
     *
     * @param Request $request
     * @param Booking $booking
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function updateBooking(Request $request, Vehicle $vehicle, Booking $booking)
    {
        

        $booking->fill($request->all());
        $booking->save();
        $this->changeSlotsStatus($vehicle,$booking->id, 2);
        return api_response($booking->fresh(['vehicle' => function ($with) {
            $with->select('id', 'make', 'model', 'variant', 'year', 'deposit');
        }]));
    }

    /**
     * Update a booking against booking log
     *
     * @param BookingLog $log
     */
    protected function updateBookingFromLog(BookingLog $log, Request $request)
    {
        $booking = $log->booking;

        // $booking->fill($log->requested_data);

        $vehicle = $booking->vehicle;

        if ($log->requested_data['status'] == 1  && $request->status==1) {
            // User approved booking do payment here
           $this->deductDeposit($booking, $booking->user);//  deduct after booking accepted

           $this->generateContract($booking); // generate after booking accepted
        }

        if ($log->requested_data['status'] == 8) {
            $booking->status = 8;
            $booking->end_date = Carbon::parse($log->requested_data['end_date'])->format("Y-m-d");

            $this->extendBooking($booking,$log);
            $this->updateContractTemplate($booking);            

        } elseif ($log->requested_data['status'] == 6 && isset($log->requested_data['end_date'])) {
            // $this->changeSlotsStatus($vehicle);
            // Accept early cancelation and update booking end date
            $booking->status = 4;
            $booking->end_date = Carbon::parse($log->requested_data['end_date'])->format("Y-m-d");
            $this->earlyCancleBooking($booking,$log);
            $this->updateContractTemplate($booking);
        } else {
            $booking->status = $request->status;

        }

        $booking->save();
    }

    /**
     * get notification string for requested data
     *
     * @param BookingLog $log
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    protected function getStatusNotifyString(BookingLog $log)
    {
        $booking = $log->booking;
        $data = $log->requested_data;
        $status = $data['status'];
        

        $booking->status = $status;
        $booking->save();

        return trans('booking.requested', [
            'user' => $log->requested->name,
            'status' => strtolower($booking->statusTypes[$status])
        ]);
    }

    /**
     * get notification string for requested data
     *
     * @param BookingLog $log
     * @return \Illuminate\Contracts\Translation\Translator|string
     */
    protected function getFulfillNotifyString(BookingLog $log)
    {
        $booking = $log->booking;


        if(isset($log->requested_data['old_status']) && $log->requested_data['old_status']===5 && request()->status===4)
            return trans('booking.decline', [
            'status' => strtolower($booking->statusTypes[$log->requested_data['old_status']])
        ]);

        if(isset($log->requested_data['old_status']) && $log->requested_data['old_status']===7 && request()->status===4)
            return trans('booking.decline', [
            'status' => strtolower($booking->statusTypes[$log->requested_data['old_status']])
        ]);

        if(isset($log->requested_data['old_status']) && $log->requested_data['old_status']===5)
            return trans('booking.fulfilled', [
            'user' => $log->fulfilled->name,
            'status' => strtolower($booking->statusTypes[6])
        ]);

        return trans('booking.fulfilled', [
            'user' => $log->fulfilled->name,
            'status' => strtolower($booking->statusTypes[$booking->status])
        ]);
    }

    protected function extendBooking($booking,$log){
        $booking->vehicle->timeslots()->where("day","<=",Carbon::parse($log->requested_data['end_date'])->format("Y-m-d"))
                             ->update(["status" => 2, "booking_id" => $booking->id]);



    }

    protected function earlyCancleBooking($booking,$log){
        $start_date = $booking->timeslots->first();
        $booking->timeslots()->where("day",">",Carbon::parse($log->requested_data['end_date'])->format("Y-m-d"))->update(["status" => 1, "booking_id" => null]);

    }

        public function verifySlots(Request $request)
    {
        $dates = $this->generateDateRange($request->start_date, $request->end_date);

        $vehicle = Vehicle::whereId($request->vehicle_id)->with(['timeSlots' => function ($with) use ($request) {
            $with->where('status', 1);
            $with->whereBetween('day', [Carbon::parse($request->start_date), Carbon::parse($request->end_date)]);
        }])->first();

        // validate days for free time slots
        $vehicle->timeSlots->each(function ($ts) use (&$dates) {
            if (false !== $key = array_search($ts->day->format('Y-m-d'), $dates))
                unset($dates[$key]);
        });
        $dates = array_values($dates);

        return api_response(!count($dates));
    }

    protected function updateContractTemplate($booking){
            $dataPlaced = $this->compileTemplate($booking);

            $fileName = '/document/' . md5($booking->vehicle->vehicle_name . '-' . $booking->id) . '.pdf';

            $pdfData = ['content' => $dataPlaced];

            \PDF::loadView('pdf.contract', $pdfData)->save(storage_path('app/public' . $fileName));
    }

    protected function cancelBookingRequest($request,$booking_id){
            $booking = $request->user()->booking()->whereId($booking_id)->first();
            if(!$booking)
                return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);
            $result = event(new BookingUnsuccessfull($booking));
            
    }

    protected function inspectionNotifyDriver($booking){

        $code = $booking->code()->first();
        if(!$code){
            $code = mt_rand(1000, 9999);
            $booking->code()->create([
                'confirm_code' => $code,
                 'status' => 0
            ]);
        } else{
            $code = $code->confirm_code;
        }

        $booking->user->notify(new BookingNotify([
            'id' => $booking->id,
            'type' => 'Booking',
            'status' =>  INSPECTION_CODE_GENERATED,
            'inspection_code'  => $code,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
            'title' => 'Owner completed vehicle inspection',
            'user' => request()->user()->name,
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
        ]));

    }

    public function getContractData($booking_id)
    {

        $booking = Booking::find($booking_id);
        if(!$booking)
            return api_response(trans('booking.unauthenticated', ['name' => request()->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);
        if($booking->contract->isEmpty()){

             $data['start_date'] = $booking->start_date;
             $data['end_date'] = $booking->end_date;
             $data['deposit_paid_date'] = $booking->payments->first()->created_at;
             $data['deposit'] = $booking->deposit;
             $data['vehicle_make'] =  $booking->vehicle->vehicle_make;
             $data['vehicle_registration_number'] =  $booking->vehicle->registration_number;
             $data['vehicle_model'] =  $booking->vehicle->vehicle_model;
             $data['client_name'] =  $booking->user->name;
             $data['driving'] =  $booking->user->client->driving;
             $data['pco_number'] =  $booking->user->client->pco_number;
             $data['pco_expiry_date'] =  $booking->user->client->pco_expiry_date;
             $data['weekly_rent_cost'] =  $booking->vehicle->rent;

            $contract = $booking->contract()->create($data);
            
        } 
         else
            return $booking->contract->first();

        return $contract->fresh();
    }

}