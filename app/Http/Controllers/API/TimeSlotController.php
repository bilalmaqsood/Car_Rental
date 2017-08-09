<?php

namespace Qwikkar\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Concerns\BookingOperations;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\TimeSlot;
use Qwikkar\Models\Vehicle;

class TimeSlotController extends Controller
{
    use BookingOperations;

    /**
     * Add time slots for vehicle
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function addSlots(Request $request)
    {
        $this->validate($request, [
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'days' => 'required|array',
            'days.*' => 'date'
        ]);
        $data = $request->days;
        $vehicle = $request->user()->owner->vehicles->where('id', $request->vehicle_id)->first();
        $timeslots = $vehicle->timeSlots()->count();
        $filtered = $vehicle->timeSlots()->whereIn('day', $request->days)->get()->map(function ($ts) {
            return $ts->day->format('Y-m-d');
        });

        if (!$vehicle)
            return api_response(trans('vehicle.not-associated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $days = collect($request->days)->map(function ($date) use ($filtered) {
            if (false === $filtered->search($date))
                return new TimeSlot(['day' => $date]);
        })->reject(function ($TimeSlot) {
            return empty($TimeSlot);
        })->values();

        $vehicle->timeSlots()->saveMany($days);
        if($timeslots==0)
           $vehicle->available_from = Carbon::parse(reset($data));
        $vehicle->available_to = Carbon::parse(end($data));
        $vehicle->save();

        return api_response(trans('time_slots.created', ['no' => $days->count(), 'vehicle' => $vehicle->vehicle_name]));
    }

    /**
     * Verify time slots for vehicle
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
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

    public function getSlots($vehicle_id)
    {

        $vehicle = Vehicle::whereId($vehicle_id)->has("timeSlots")->with("timeSlots")->first();
        if(!$vehicle)
             return api_response("error",404);

        return api_response($vehicle->timeSlots);

    }
}
