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
        $this->changeSlotsStatus($vehicle, 2);

        // validate if booking already exists
        if (
        $vehicle->booking
            ->where('start_date', Carbon::parse($request->start_date))
            ->where('end_date', Carbon::parse($request->end_date))
            ->count()
        )
            return api_response(trans('booking.exist', ['vehicle' => $vehicle->vehicle_name]), 409);

        $booking = new Booking($request->all());
        $booking->vehicle()->associate($vehicle);
        $booking->user()->associate($request->user());
        $booking->save();

        return api_response(trans('booking.create', ['vehicle' => $vehicle->vehicle_name]));
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
     * @param Vehicle $vehicle
     * @param Booking $booking
     * @return array|\Illuminate\Http\JsonResponse
     */
    protected function updateBooking(Request $request, Vehicle $vehicle, Booking $booking)
    {
        $this->changeSlotsStatus($vehicle, 2);

        $booking->fill($request->all());
        $booking->save();

        return api_response($booking);
    }
}