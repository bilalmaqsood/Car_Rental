<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\TimeSlot;

class TimeSlotController extends Controller
{
    /**
     * Add time slots for vehicle
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'days' => 'required|array',
            'days.*' => 'date'
        ]);

        $vehicle = $request->user()->owner->vehicles->where('id', $request->vehicle_id)->first();

        if (!$vehicle)
            return api_response(trans('vehicle.not-associated', ['name' => $request->user()->name]), Response::HTTP_UNPROCESSABLE_ENTITY);

        $days = collect($request->days)->map(function ($date) {
            return new TimeSlot(['day' => $date]);
        });

        $vehicle->timeSlots()->saveMany($days);

        return api_response(trans('time_slots.created', ['no' => $days->count(), 'vehicle' => $vehicle->vehicle_name]));
    }
}
