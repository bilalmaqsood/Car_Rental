<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Concerns\Disputable;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Booking;
use Qwikkar\Models\Inspection;
use Qwikkar\Models\Vehicle;

class InspectionController extends Controller
{
    use Disputable;

    /**
     * InspectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('owner')->except('index');

        $this->middleware('not-admin')->only('index');
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

        return api_response($booking->vehicle->inspection);
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
            'data' => 'required|array|min:1',
            'data.*.type' => 'required|in:front,rear,driver_side,off_side,notes',
            'data.*.status' => 'in:0,1',
            'data.*.is_return' => 'boolean',
            // 'data.*.x_axis' => 'numeric',
            // 'data.*.y_axis' => 'numeric',
            'data.*.path' => 'string',
            'data.*.note' => 'string',
        ]);
        $data = collect($request->data)->first();
        
        $booking = Booking::findOrFail($booking_id);
        if ($booking->status < 4 && $data['is_return'])
            return api_response(trans('booking.return'), Response::HTTP_CONFLICT);
        
        if ($booking->status >= 4 && !$data['is_return'])
            return api_response(trans('booking.handover'), Response::HTTP_CONFLICT);

        $spots = collect($request->data)
            ->map(function ($spot) use ($request, $booking) {

                $inspection = Inspection::firstOrNew(collect($spot)->only('x_axis', 'y_axis', 'path')->all());

                if (!$inspection->exists) {
                    $inspection->fill($spot);
                    $inspection->vehicle()->associate($booking->vehicle);
                    $inspection->save();

                    return $inspection;
                }
            })
            ->reject(function ($spot) {
                return $spot == null;
            })
            ->values();

        if ($spots->count() && isset($data['status']) && $data['status'] == 1 && $booking->status != 10) {

            $this->openDispute($request, $booking, $spots->first());

            $booking->user->client->update(['status' => 1]);

            $booking->update(['status' => 10]);
        }

        return api_response(trans('booking.inspection_added', ['count' => $spots->count()]));
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

        $inspection = $booking->vehicle->inspection()->where('id', $id)->first();

        if (!$inspection) throw new ModelNotFoundException();

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
        $this->validate($request, [
            'type' => 'required|in:front,rear,driver_side,off_side,notes',
            'status' => 'in:0,1',
            'is_return' => 'boolean',
            'x_axis' => 'numeric',
            'y_axis' => 'numeric',
            'path' => 'string',
            'note' => 'string',
        ]);

        $data = collect($request->data)->first();

        $booking = Booking::findOrFail($booking_id);

        $inspection = $booking->vehicle->inspection()->where('id', $id)->first();

        if (!$inspection) throw new ModelNotFoundException();

        if ($booking->status < 4 && $data['is_return'])
            return api_response(trans('booking.return'), Response::HTTP_CONFLICT);

        if ($booking->status >= 4 && !$data['is_return'])
            return api_response(trans('booking.handover'), Response::HTTP_CONFLICT);

        $inspection->fill($request->all());
        $inspection->save();

        if (isset($data['status']) && $data['status'] == 1 && $booking->status != 10) {

            $this->openDispute($request, $booking, $inspection);

            $booking->user->client->update(['status' => 1]);

            $booking->update(['status' => 10]);
        }

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

        $inspection = $booking->vehicle->inspection()->where('id', $id)->first();

        if (!$inspection) throw new ModelNotFoundException();

        return api_response($inspection->delete());
    }
}
