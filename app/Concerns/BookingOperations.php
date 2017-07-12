<?php

namespace Qwikkar\Concerns;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Models\BalanceLog;
use Qwikkar\Models\Booking;
use Qwikkar\Models\BookingLog;
use Qwikkar\Models\BookingPayment;
use Qwikkar\Models\User;
use Qwikkar\Models\Vehicle;
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
    protected function changeSlotsStatus(Vehicle $vehicle, $status = 1)
    {
        $vehicle->timeSlots->each(function ($ts) use ($status) {
            $ts->status = $status;
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
            ->whereNotIn('status', [3, 4, 7])
            ->count()
        )
            return api_response(trans('booking.exist', ['vehicle' => $vehicle->vehicle_name]), Response::HTTP_CONFLICT);

        $this->changeSlotsStatus($vehicle, 2);

        $booking = new Booking($request->all());

        $booking->deposit = $vehicle->deposit;

        $booking->vehicle()->associate($vehicle);
        $booking->user()->associate($request->user());

        $booking->save();

        Couponize::processPromoCode($booking, $request);

        $this->deductDeposit($booking, $request->user());

        $this->generateContract($booking);

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
            $this->makePaymentFromCard($user, $booking->deposit);

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
        ]));

        // update booking status for confirmed to requested
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
            'image' => $booking->vehicle->images->first(),
            'title' => 'Booking requested',
            'user' => $user->name,
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
            'deposit' => $booking->deposit,
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

        $booking->documents = collect([$fileName]);
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

        if($signatures)
            $signatures->put($request->user()->types->first()->name, $request->signature->store('images', 'public'));
        else
            $signatures = collect([
                $request->user()->types->first()->name => $request->signature->store('images', 'public')
            ]);

        if ($signatures->has('client')) {
            $booking->status = 3;
            $pdfData['driver_signature'] = $booking->signatures->get('client');
        }

        if ($signatures->has('owner')) {
            $booking->status = 2;
            $pdfData['owner_signature'] = $booking->signatures->get('owner');
        }

        if ($signatures->has('owner') && $signatures->has('client')) $booking->status = 4;

        $booking->signatures = $signatures;
        $booking->save();

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

        $user->addBalance($amount);
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
        $this->changeSlotsStatus($vehicle, 2);

        $booking->fill($request->all());
        $booking->save();

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

        $booking->fill($log->requested_data);

        if (isset($log->requested_data['start_date']) || isset($log->requested_data['end_date'])) {
            $booking->status = 8;
        } elseif ($log->requested_data['status'] == 5) {
            $booking->status = 6;
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

        if (isset($data['start_date']) || isset($data['end_date'])) {
            $status = 5;
        } else {
            $status = $data['status'];
        }

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

        return trans('booking.fulfilled', [
            'user' => $log->fulfilled->name,
            'status' => strtolower($booking->statusTypes[$booking->status])
        ]);
    }
}