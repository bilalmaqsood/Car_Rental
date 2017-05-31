<?php

namespace Qwikkar\Concerns;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Qwikkar\Models\Booking;
use Qwikkar\Models\Vehicle;

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
     * Start the booking of provided Vehicle
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function proceedToBooking(Request $request, Vehicle $vehicle)
    {
        $booking = Booking::firstOrNew($request->all());

        $booking->vehicle()->associate($vehicle);
        $booking->user()->associate($request->user());

        $booking->save();

        Couponize::processPromoCode($booking, $request);

        return api_response(trans('booking.create', ['vehicle' => $vehicle->vehicle_name]));
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
    protected function updateBooking(Request $request, Booking $booking)
    {
        $booking->fill($request->all());
        $booking->save();

        return api_response($booking->fresh(['vehicle' => function ($with) {
            $with->select('id', 'make', 'model', 'variant', 'year', 'deposit');
        }]));
    }
}