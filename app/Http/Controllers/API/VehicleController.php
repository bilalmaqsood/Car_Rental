<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Http\Requests\VehicleModel;
use Qwikkar\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * VehicleController constructor.
     */
    public function __construct()
    {
        $this->middleware('owner')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return api_response($request->user()->owner->vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleModel $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleModel $request)
    {
        $vehicle = Vehicle::firstOrNew([
            'make' => $request->make,
            'model' => $request->model,
            'variant' => $request->variant,
            'year' => $request->year
        ]);

        if (!$vehicle->exists) {
            $vehicle->fill($request->all());

            $request->user()->owner->vehicles()->save($vehicle);
        }

        return api_response($vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return api_response(Vehicle::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleModel $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleModel $request, $id)
    {
        $vehicle = $request->user()->owner->vehicles->where('id', $id)->first();

        if (!$vehicle) abort(404);

        $vehicle->fill($request->all());

        $vehicle->save();

        return api_response($vehicle);
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
        $vehicle = $request->user()->owner->vehicles->where('id', $id)->first();

        if (!$vehicle) abort(404);

        $vehicle->delete();

        return api_response(trans('vehicle.deleted', ['name' => $request->user()->last_name]));
    }
}
