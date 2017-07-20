<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;

class ReturnVehicleController extends Controller
{
    /**
     * InspectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('owner');
    }

    /**
     * Get all inspections of a booking
     *
     * @param $booking_id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function index($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);

        return api_response($booking->returnVehicle);
    }

    /**
     * add an inspections of a booking
     *
     * @param Request $request
     * @param $booking_id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $booking_id)
    {
        $this->validate($request, [
            'type' => 'required|in:front,rear,driver_side,off_side,notes',
            'data' => 'required|array',
            'status' => 'in:0,1'
        ]);

        $booking = Booking::findOrFail($booking_id);

        if ($booking->returnVehicle->where('type', $request->type)->count()) {
            $returnVehicle = $booking->returnVehicle->where('type', $request->type)->first();
            $returnVehicle->fill($request->all());
            $returnVehicle->save();
        } else {
            $booking->returnVehicle()->create($request->all());
        }

        if ($request->has('status') && $request->status == 1) {
            $booking->status = 10;
            $booking->save();
        }

        $booking->load('returnVehicle');

        return api_response($booking->returnVehicle->where('type', $request->type)->first());
    }

    /**
     * Get an inspection of a booking
     *
     * @param $booking_id
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function show($booking_id, $id)
    {
        $booking = Booking::findOrFail($booking_id);

        $returnVehicle = $booking->returnVehicle()->where('id', $id)->first();

        if (!$returnVehicle)
            throw new ModelNotFoundException();

        return api_response($returnVehicle);
    }

    /**
     * Update an inspection of a booking
     *
     * @param Request $request
     * @param $booking_id
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $booking_id, $id)
    {
        $this->validate($request, [
            'type' => 'in:front,rear,driver_side,off_side,notes',
            'data' => 'required|array',
            'status' => 'in:0,1'
        ]);

        $booking = Booking::findOrFail($booking_id);

        $returnVehicle = $booking->returnVehicle()->where('id', $id)->first();

        if (!$returnVehicle)
            throw new ModelNotFoundException();

        $returnVehicle->data = $request->data;

        if ($request->has('status'))
            $returnVehicle->status = $request->status;

        $returnVehicle->save();

        if ($request->has('status') && $request->status == 1) {
            $booking->status = 10;
            $booking->save();
        }

        return api_response($returnVehicle);
    }

    /**
     * Destroy an inspection of a booking
     *
     * @param $booking_id
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destroy($booking_id, $id)
    {
        $booking = Booking::findOrFail($booking_id);

        $returnVehicle = $booking->returnVehicle()->where('id', $id)->first();

        if (!$returnVehicle)
            throw new ModelNotFoundException();

        return api_response($returnVehicle->delete());
    }
}
