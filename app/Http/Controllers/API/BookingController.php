<?php

namespace Qwikkar\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Concerns\BookingOperations;
use Qwikkar\Events\BookingUnsuccessfull;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;
use Qwikkar\Models\BookingLog;
use Qwikkar\Models\Feedback;
use Qwikkar\Models\Vehicle;
use Qwikkar\Notifications\BookingNotify;

class BookingController extends Controller
{
    use BookingOperations;

    /**
     * BookingController constructor.
     */
    public function __construct()
    {
        $this->middleware('not-admin')->only(['index', 'show']);

        $this->middleware('owner')->only(['destroy', 'updateStatusFulfill']);

        $this->middleware('client')->only(['store', 'update', 'updateStatusRequest','pickupTimeslot']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->isOwner()) {
            $result = $request->user()->owner->vehicles()->with(['booking' => function ($with) {
                $with->with(['vehicle' => function ($vWith) {
                    $vWith->select('id', 'make', 'model', 'variant', 'year', 'images','insurance' ,'rent', 'seats', 'mpg', 'fuel', 'transmission', 'mileage', 'available_from');
                }]);
            }])->orderBy("id","desc")->get()->map(function ($v) {
                return $v->booking;
            });

            $bookingList = collect();
            $result->map(function ($b) use ($bookingList) {
                if ($b->count())
                    $b->map(function ($v) use ($bookingList) {
                        $bookingList->push($v);
                    });
            });

            if($bookingList){
                //sort bookings by desc
            $bookingList = $bookingList->toArray();
            
               usort($bookingList,function($a,$b){
                    return $b['id'] - $a['id'];
                });
            }
        } else
            $bookingList = $request->user()->booking()->with(['vehicle' => function ($vWith) {
                $vWith->select('id', 'make', 'model', 'variant', 'year', 'images', 'insurance','rent', 'seats', 'mpg', 'fuel', 'transmission', 'mileage', 'available_from');
            }])->orderBy("id","desc")->get();

        return api_response($bookingList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (!$request->user()->client->dlc)
            return api_response('Driver\'s documents are not verified.', Response::HTTP_BAD_REQUEST);

        if ($request->user()->client->status == 1)
            return api_response('Sorry! you have an open dispute.', Response::HTTP_BAD_REQUEST);

        $this->validate($request, [
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:today',
            'location' => 'string',
            'promo_code' => 'exists:promo_codes,code'
        ]);

        // validate minimum booking requirements
        $dates = $this->generateDateRange($request->start_date, $request->end_date);
        if (count($dates) < 7)
            return api_response(trans('booking.minimum'), Response::HTTP_UNPROCESSABLE_ENTITY);

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

        if (count($dates))
            return api_response(['message' => trans('time_slots.not-match'), 'data' => $dates], Response::HTTP_CONFLICT);

        if ($request->user()->current_balance < $vehicle->deposit && !$request->user()->creditCard->where('default', 1)->first())
            return api_response(trans('booking.deposit'), Response::HTTP_PAYMENT_REQUIRED);

        return $this->proceedToBooking($request, $vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $booking = Booking::whereId($id)->with(['vehicle' => function ($with) {
            $with->select('id', 'make', 'model', 'variant', 'year', 'mileage', 'seats','insurance', 'transmission', 'fuel', 'mile_cap', 'rent', 'documents');
        }, 'bookingLog' => function ($with) {
            $with->with(['requested', 'fulfilled']);
        }, 'user'])->first();

        return api_response($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string'
        ]);

        $booking = Booking::whereId($id)->with('vehicle')->first();

        if (!$booking)
            throw new ModelNotFoundException();

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $oldDates = $this->generateDateRange($booking->start_date, $booking->end_date);

        $dates = $this->generateDateRange($request->start_date, $request->end_date);
        if (count($dates) < 7)
            return api_response(trans('booking.minimum'), Response::HTTP_UNPROCESSABLE_ENTITY);

        $remainingDays = array_values(array_diff($dates, $oldDates));

        $vehicle = Vehicle::whereId($request->vehicle_id)->with(['timeSlots' => function ($with) use ($remainingDays) {
            $with->where('status', 1);
            $with->whereIn('day', $remainingDays);
        }])->first();

        // validate days for free time slots
        $vehicle->timeSlots->each(function ($ts) use (&$remainingDays) {
            if (false !== $key = array_search($ts->day->format('Y-m-d'), $remainingDays))
                unset($remainingDays[$key]);
        });
        $remainingDays = array_values($remainingDays);

        if (count($remainingDays))
            return api_response(['message' => trans('time_slots.not-match'), 'data' => $remainingDays], Response::HTTP_CONFLICT);

        return $this->updateBooking($request, $vehicle, $booking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $booking = Booking::whereId($id)->with('vehicle')->first();

        if (!$booking)
            throw new ModelNotFoundException();

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $dates = $this->generateDateRange($booking->start_date, $booking->end_date);

        $vehicle = Vehicle::whereId($booking->vehicle_id)->with(['timeSlots' => function ($with) use ($dates) {
            $with->where('status', 2);
            $with->whereIn('day', $dates);
        }])->first();

        $this->changeSlotsStatus($vehicle);

        $booking->delete();

        return api_response(trans('booking.delete', ['name' => $request->user()->name]));
    }

    /**
     * Update the status request of an open booking
     *
     * @param Request $request
     * @param int $id
     * @param BookingLog $log
     * @return string
     */
    public function updateStatusRequest(Request $request, $id, BookingLog $log)
    {
        $this->validate($request, [
            // 'start_date' => 'date|after_or_equal:today',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:today',
            'location' => 'string',
            'note' => 'string',
            'status' => 'in:5,7',
        ]);
        
        $status = $request->status;

        $booking = Booking::findOrFail($id);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $requestData = $request->all();
        unset($requestData['note']);

        $log->requested_note = $request->note;
        $log->requested_data = $requestData;
        $log->requested_time = Carbon::now();

        $log->requested()->associate($request->user());

        $booking->bookingLog()->save($log);

        $notiData = [
            'id' => $booking->id,
            'log_id' => $log->id,
            'type' => 'Booking',
            'status' => $status,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'note' => $request->note,
            'target_date' => $request->end_date,
            'image' => $booking->vehicle->images->first(),
            'title' => 'Booking ' . strtolower($booking->statusTypes[$status]) . ' request',
            'user' => $request->user()->name,
            'credit_card' => $booking->account?$booking->account->last_numbers:'',
            'vehicle' => $booking->vehicle->vehicle_name,
            'contract_start' => $booking->start_date,
            'contract_end' => $booking->end_date,
            'requested_data' => $requestData,
            'deposit' => $booking->deposit,
            'signatures' => [
                'owner' => $booking->signatures && $booking->signatures->has('owner'),
                'client' => $booking->signatures && $booking->signatures->has('client')
            ]
        ];

        if ($request->has('start_date') && $request->has('end_date'))
            $notiData['extend'] = [
                'contract_start' => $request->start_date,
                'contract_end' => $request->end_date,
            ];

        $booking->vehicle->owner->user->notify(new BookingNotify($notiData));

        return api_response(trans($status==7?'booking.extendrequest':'booking.earlyrequest'));
//        return api_response($this->getStatusNotifyString($log));
    }

    /**
     * Update the status fulfill of an open booking
     *
     * @param Request $request
     * @param int $id
     * @param BookingLog $log
     * @return string
     */
    public function updateStatusFulfill(Request $request, $id, BookingLog $log)
    {
        $this->validate($request, [
            'log_id' => 'exists:booking_logs,id',
            'status' => 'required|in:1,4,6,8,9',
            'note' => 'string',
        ]);

        $booking = Booking::findOrFail($id);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        if ($request->has('log_id'))
            $log = BookingLog::find($request->log_id);

        if ($log->status && $log->status == 2)
            return api_response(trans('booking.log-fulfilled', [
                'user' => $log->fulfilled->name,
                'status' => strtolower($log->booking->statusTypes[$log->booking->status])
            ]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $requestData = $request->all();
        unset($requestData['note']);
        unset($requestData['log_id']);
        
        if(isset($log->requested_data['end_date']))
        $requestData["end_date"] =  $log->requested_data['end_date']; 
         
        $requestData["old_status"] =  $log->requested_data['status'];  

        $log->requested_data = $requestData;

        $log->fulfilled_note = $request->note;
        $log->fulfilled_data = $requestData;
        $log->fulfilled_time = Carbon::now();

        $log->status = 2;

        $title = 'Booking ' . strtolower($booking->statusTypes[$request->status]);

        if ($request->status == 4 && $booking->status== 5)
            $title = 'Booking early cancellation request declined';

        if ($request->status == 4 && $booking->status== 7)
            $title = 'Booking extend request declined';

        if ($request->status == 4 && $booking->status==0){
            $title = trans('booking.request-unsuccessfull'); //Owner denided request for booking
            
            event(new BookingUnsuccessfull($booking));
            return api_response(trans('booking.request-decline'));
        }

        $log->fulfilled()->associate($request->user());

        if ($request->has('log_id'))
            $log->save();
        else
            $booking->bookingLog()->save($log);

        

        $booking->user->notify(new BookingNotify([
            'id' => $booking->id,
            'type' => 'Booking',
            'status' => $request->status,
            'old_status' => $booking->status,
            'vehicle_id' => $booking->vehicle->id,
            'image' => $booking->vehicle->images->first(),
            'title' => $title,
            'user' => $request->user()->name,
            'requested_data'  => $requestData,
            'note' => $log->requested_note,
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

        if ($request->status == 1)
            $booking->vehicle->owner->user->notify(new BookingNotify([
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => 1,
                'old_status' => 0,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Contract is available for update and sign',
                'user' =>  $booking->user->name,
                'requested_data'  => $requestData,
                'note' => $log->requested_note,
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

        if ($request->status == 9)
            $booking->user->notify(new BookingNotify([
                'id' => $booking->id,
                'type' => 'Booking',
                'status' => $request->status,
                'old_status' => $booking->status,
                'vehicle_id' => $booking->vehicle->id,
                'image' => $booking->vehicle->images->first(),
                'title' => 'Your deposit will be return after 24 hours.',
                'user' => $request->user()->name,
                'requested_data'  => $requestData,
                'note' => $log->requested_note,
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

        $this->updateBookingFromLog($log, $request);

        return api_response($this->getFulfillNotifyString($log));
    }

    /**
     * Add feedback for booking
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function giveFeedback(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $this->validate($request,[
            "rating" => "required|numeric",
             "note" => "required"
        ]);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        if (!in_array($booking->status, [12]))
            api_response(trans('booking.in-progress'), Response::HTTP_BAD_REQUEST);

        if (Feedback::whereBookingId($booking->id)->whereUserId($request->user()->id)->count())
            return api_response(trans('booking.feedback.exist'), Response::HTTP_BAD_REQUEST);

        $feedback = new Feedback($request->all());

        $feedback->booking()->associate($booking);
        $feedback->user()->associate($request->user());

        $feedback->save();

        return api_response($feedback);
    }

    /**
     * Get latest booking log
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function lastBookingLog(Request $request, $id)
    {
        $booking = Booking::whereId($id)->with(['bookingLog' => function ($query) {
            $query->whereNull('fulfilled_data')->latest()->first();
        }])->first();

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        return api_response($booking);
    }

    /**
     * Sign contract from user of booking
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function signatureBooking(Request $request, $id)
    {
        $this->validate($request, [
            'signature' => 'required|image'
        ]);

        $booking = Booking::findOrFail($id);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        if (!in_array($booking->status, [1, 2, 3]))
            api_response(trans('booking.sign', ['status' => strtolower($booking->statusTypes[$booking->status])]), Response::HTTP_BAD_REQUEST);

        $this->signContract($request, $booking);

        return api_response(trans('booking.signature', ['name' => $request->user()->name]));
    }

    /**
     * Add weekly mileage of booked vehicle
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function weeklyMileageService(Request $request, $id)
    {
        $this->validate($request, [
            'miles' => 'required|numeric'
        ]);

        $booking = Booking::findOrFail($id);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $booking->vehicle->mileage += $request->miles;
        $booking->vehicle->save();

        return api_response(trans('booking.mileage', ['name' => $booking->vehicle->vehicle_name, 'miles' => $request->miles]));
    }

    /**
     * Delete the booking request and free the timeslots of vehicle
     *
     * @param Request $request
     * @param Booking ID $id
     */
    public function cancelRequest(Request $request, $id)
    {
        $this->cancelBookingRequest($request,$id);
    }

    public function pickupTimeslot(Request $request,$id)
    {
        $booking = Booking::findOrFail($id);
        
        if(!$booking)
             return api_response(trans('booking.unauthenticated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

         $pickup_time = $request->pickup_time;

         $booking->update(["pickup_time" => $pickup_time]);

         return  api_response(trans('booking.pickup_time'));
    }
}
