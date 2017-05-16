<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\TimeSlot;

class TimeSlotController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'vehicle_id' => 'required|numeric|exists:vehicles,id',
            'days' => 'required|array',
            'days.*' => 'date'
        ]);

        $vehicle = $request->user()->owner->vehicles->where('id', $request->vehicle_id)->first();

        if(!$vehicle)
            return response()
                ->json(['vehicle_id' => [
                    trans('vehicle.not-associated', ['name' => $request->user()->last_name])
                ]], 422);

        $days = collect($request->days)->map(function ($date) {
            return new TimeSlot(['day' => $date]);
        });

        $vehicle->timeSlots()->saveMany($days);

        return api_response(trans('time_slots.created', ['no' => $days->count(), 'vehicle' => $vehicle->vehicle_name]));
    }
}
