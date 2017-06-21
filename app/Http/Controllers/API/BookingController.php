<?php

namespace Qwikkar\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Concerns\BookingOperations;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;
use Qwikkar\Models\BookingLog;
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

        $this->middleware('client')->only(['store', 'update', 'updateStatusRequest']);
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
                    $vWith->select('id', 'make', 'model', 'variant', 'year', 'images');
                }]);
            }])->get()->map(function ($v) {
                return $v->booking;
            });

            $bookingList = collect();
            $result->map(function ($b) use ($bookingList) {
                if ($b->count())
                    $b->map(function ($v) use ($bookingList) {
                        $bookingList->push($v);
                    });
            });
        } else
            $bookingList = $request->user()->booking()->with(['vehicle' => function ($vWith) {
                $vWith->select('id', 'make', 'model', 'variant', 'year', 'images');
            }])->get();

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
        $this->validate($request, [
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string',
            'promo_code' => 'exists:promo_codes,code'
        ]);

        // validate minimum booking requirements
        $dates = $this->generateDateRange($request->start_date, $request->end_date);
        if (count($dates) < 7)
            return api_response(trans('booking.minimum'), Response::HTTP_UNPROCESSABLE_ENTITY);

        $vehicle = Vehicle::whereId($request->vehicle_id)->with(['booking' => function ($with) use ($request) {
            $with->whereDate('end_date', '>=', Carbon::parse($request->start_date));
        }])->first();

        $invalidDates = [];
        $bookingDates = [];
        collect($dates)->map(function ($d) use ($vehicle, &$bookingDates, &$invalidDates) {
            $time = strtotime($d);
            if ($time >= $vehicle->available_from->getTimestamp() && $time <= $vehicle->available_to->getTimestamp()) {
                $vehicle->booking->map(function ($b) use ($d, $time, &$bookingDates) {
                    if ($time >= $b->start_date->getTimestamp() && $time <= $b->end_date->getTimestamp())
                        $bookingDates[] = $d;
                });
            } else {
                $invalidDates[] = $d;
            }
        });

        if (count($invalidDates))
            return api_response(['message' => trans('booking.not-match'), 'data' => $invalidDates], Response::HTTP_CONFLICT);

        if (count($bookingDates))
            return api_response(['message' => trans('booking.booked', ['vehicle' => $vehicle->vehicle_name]), 'data' => $bookingDates], Response::HTTP_CONFLICT);

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
        $booking = Booking::whereId($id)->with(['vehicle' => function ($with) {
            $with->select('id', 'make', 'model', 'variant', 'year', 'mileage', 'seats', 'transmission', 'fuel', 'mile_cap', 'rent');
        }])->first();

        if (!$booking)
            return abort(Response::HTTP_NOT_FOUND);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->last_name]), Response::HTTP_UNPROCESSABLE_ENTITY);

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
            return abort(Response::HTTP_NOT_FOUND);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->last_name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $oldDates = $this->generateDateRange($booking->start_date, $booking->end_date);

        $dates = $this->generateDateRange($request->start_date, $request->end_date);
        if (count($dates) < 7)
            return api_response(trans('booking.minimum'), Response::HTTP_UNPROCESSABLE_ENTITY);

        $remainingDays = array_values(array_diff($dates, $oldDates));

        $vehicle = Vehicle::whereId($request->vehicle_id)->with(['booking' => function ($with) use ($request) {
            $with->whereDate('end_date', '>=', Carbon::parse($request->start_date));
        }])->first();

        $invalidDates = [];
        $bookingDates = [];
        collect($remainingDays)->map(function ($d) use ($vehicle, &$bookingDates, &$invalidDates) {
            $time = strtotime($d);
            if ($time >= $vehicle->available_from->getTimestamp() && $time <= $vehicle->available_to->getTimestamp()) {
                $vehicle->booking->map(function ($b) use ($d, $time, &$bookingDates) {
                    if ($time >= $b->start_date->getTimestamp() && $time <= $b->end_date->getTimestamp())
                        $bookingDates[] = $d;
                });
            } else {
                $invalidDates[] = $d;
            }
        });

        if (count($invalidDates))
            return api_response(['message' => trans('booking.not-match'), 'data' => $invalidDates], Response::HTTP_CONFLICT);

        if (count($bookingDates))
            return api_response(['message' => trans('booking.booked', ['vehicle' => $vehicle->vehicle_name]), 'data' => $bookingDates], Response::HTTP_CONFLICT);

        return $this->updateBooking($request, $booking);
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
            return abort(Response::HTTP_NOT_FOUND);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->last_name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $booking->delete();

        return api_response(trans('booking.delete', ['name' => $request->user()->last_name]));
    }

    /**
     * Update the status request of an open booking
     *
     * @param Request $request
     * @param int $id
     * @return string
     */
    public function updateStatusRequest(Request $request, $id, BookingLog $log)
    {
        $this->validate($request, [
            'start_date' => 'date',
            'end_date' => 'date',
            'location' => 'string',
            'note' => 'string',
            'status' => 'in:3,5',
        ]);

        $booking = Booking::find($id);

        $requestData = $request->all();
        unset($requestData['note']);

        $log->requested_note = $request->note;
        $log->requested_data = $requestData;
        $log->requested_time = Carbon::now();

        $log->requested()->associate($request->user());

        $booking->bookingLog()->save($log);

        // notify owner of vehicle to complete the action

        return api_response($this->getStatusNotifyString($log));
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
            'status' => 'in:2,4,6',
            'note' => 'string',
        ]);

        $booking = Booking::find($id);

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

        $log->requested_data = $requestData;

        $log->fulfilled_note = $request->note;
        $log->fulfilled_data = $requestData;
        $log->fulfilled_time = Carbon::now();

        $log->status = 2;

        $log->fulfilled()->associate($request->user());

        if ($request->has('log_id'))
            $log->save();
        else
            $booking->bookingLog()->save($log);

        if ($booking->status == 1 && $request->status == 2)
            $booking->user->notify(new BookingNotify([
                'id' => $booking->id,
                'title' => 'Booking approved',
                'user' => $request->user()->name,
                'vehicle' => $booking->vehicle->vehicle_name,
                'contract_start' => $booking->start_date,
                'contract_end' => $booking->end_date,
                'deposit' => $booking->deposit,
            ]));

        $this->updateBookingFromLog($log);

        return api_response($this->getFulfillNotifyString($log));
    }
}
