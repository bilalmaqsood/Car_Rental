<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;

class InspectionController extends Controller
{
    /**
     * InspectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('not-admin');
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

        return api_response($booking->inspection);
    }

    /**
     * add an inspection of a booking
     *
     * @param Request $request
     * @param $booking_id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $booking_id)
    {
        $this->validate($request, [
            'type' => 'required|in:front,rear,driver_side,off_side,notes',
            'data' => 'required|array'
        ]);

        $booking = Booking::findOrFail($booking_id);

        if ($booking->inspection->where('type', $request->type)->count()) {
            $inspection = $booking->inspection->where('type', $request->type)->first();
            $inspection->fill($request->all());
            $inspection->save();
        } else {
            $booking->inspection()->create($request->all());
        }

        $booking->load('inspection');

        return api_response($booking->inspection->where('type', $request->type)->first());
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

        $inspection = $booking->inspection()->where('id', $id)->first();

        if (!$inspection)
            throw new ModelNotFoundException();

        return api_response($inspection);
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
        $booking = Booking::findOrFail($booking_id);

        $inspection = $booking->inspection()->where('id', $id)->first();

        if (!$inspection)
            throw new ModelNotFoundException();

        $inspection->fill($request->all());
        $inspection->save();

        return api_response($inspection);
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

        $inspection = $booking->inspection()->where('id', $id)->first();

        if (!$inspection)
            throw new ModelNotFoundException();

        return api_response($inspection->delete());
    }
}
