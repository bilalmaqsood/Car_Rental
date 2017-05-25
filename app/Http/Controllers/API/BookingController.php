<?php

namespace Qwikkar\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Concerns\BookingOperations;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;
use Qwikkar\Models\Vehicle;

class BookingController extends Controller
{
    use BookingOperations;

    /**
     * BookingController constructor.
     */
    public function __construct()
    {
        $this->middleware('not-admin')->only(['index', 'show']);

        $this->middleware('client')->only(['store', 'update', 'destroy']);
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
                    $vWith->select('id', 'make', 'model', 'variant', 'year');
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
                $vWith->select('id', 'make', 'model', 'variant', 'year');
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
            'location' => 'required|string'
        ]);

        // validate minimum booking requirements
        $dates = $this->generateDateRange($request->start_date, $request->end_date);
        if (count($dates) < 7)
            return api_response(trans('booking.minimum'), Response::HTTP_UNPROCESSABLE_ENTITY);

        $vehicle = Vehicle::whereId($request->vehicle_id)->with(['timeSlots' => function ($with) {
            $with->where('status', 1);
            $with->whereDate('day', '>=', Carbon::now()->format('Y-m-d'));
        }])->first();

        // validate days for free time slots
        $vehicle->timeSlots->each(function ($ts) use (&$dates) {
            if (false !== $key = array_search($ts->day->format('Y-m-d'), $dates))
                unset($dates[$key]);
        });
        $dates = array_values($dates);

        if (count($dates))
            return api_response(['message' => trans('time_slots.not-match'), 'data' => $dates], Response::HTTP_CONFLICT);

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
        $booking = Booking::whereId($id)->with('vehicle')->first();

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
            return abort(Response::HTTP_NOT_FOUND);

        if ($this->validateBooking($booking, $request))
            return api_response(trans('booking.unauthenticated', ['name' => $request->user()->last_name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $dates = $this->generateDateRange($booking->start_date, $booking->end_date);

        $vehicle = Vehicle::whereId($booking->vehicle_id)->with(['timeSlots' => function ($with) use ($dates) {
            $with->where('status', 2);
            $with->whereIn('day', $dates);
        }])->first();

        $this->changeSlotsStatus($vehicle);

        $booking->delete();

        return api_response(trans('booking.delete', ['name' => $request->user()->last_name]));
    }
}
