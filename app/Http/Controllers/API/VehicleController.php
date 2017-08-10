<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $vehicle = new Vehicle([
            'make' => $request->make,
            'model' => $request->model,
            'variant' => $request->variant,
            'year' => $request->year
        ]);

        if (!$vehicle->exists) {
            $vehicle->fill($request->except(['available_from', 'available_to', 'vlc']));

            $request->user()->owner->vehicles()->save($vehicle);

            $vehicle->contractTemplate()->create([
                'template' => File::get(resource_path('stubs/contract-template.stub'))
            ]);
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
        $vehicle = Vehicle::whereId($id)->with(['owner' => function ($with) {
            $with->with('user');
        }, 'timeSlots'])->first();

        if (!$vehicle)
            throw new ModelNotFoundException();

        return api_response($vehicle);
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

        if (!$vehicle) throw new ModelNotFoundException();
        logger($vehicle->images);
        $vehicle->fill($request->except(['available_from', 'available_to', 'vlc']));

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
        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        if (!$vehicle) throw new ModelNotFoundException();

        $vehicle->delete();

        return api_response(trans('vehicle.deleted', ['name' => $request->user()->name]));
    }
}
