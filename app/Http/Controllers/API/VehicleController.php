<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Http\Requests\VehicleModel;
use Qwikkar\Models\ContractTemplate;
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
        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        if (!$vehicle) throw new ModelNotFoundException();

        $vehicle->delete();

        return api_response(trans('vehicle.deleted', ['name' => $request->user()->name]));
    }

    /**
     * Get contract template for vehicle
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getContractTemplate(Request $request, $id)
    {
        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        if (!$vehicle) throw new ModelNotFoundException();

        return response($vehicle->contractTemplate ? $vehicle->contractTemplate->template : '')->header('Content-Type', 'text/plain');
    }

    /**
     * Add contract template for vehicle
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function contractTemplate(Request $request, $id)
    {
        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        $contractTemplate = $vehicle->contractTemplate;
        if (!$contractTemplate)
            $contractTemplate = new ContractTemplate();

        $contractTemplate->template = $request->getContent();

        if ($vehicle->contractTemplate)
            $contractTemplate->save();
        else
            $vehicle->contractTemplate()->save($contractTemplate);

        return api_response(trans('vehicle.contract.added', ['vehicle' => $vehicle->vehicle_name]));
    }

    /**
     * Add contract template for vehicle
     *
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function contractSignature(Request $request, $id)
    {
        $this->validate($request, [
            'signature' => 'required|string'
        ]);

        $vehicle = $request->user()->owner->vehicles()->where('id', $id)->first();

        $contractTemplate = $vehicle->contractTemplate;
        if (!$contractTemplate)
            $contractTemplate = new ContractTemplate();

        $contractTemplate->owner_signature = $request->signature;

        if ($vehicle->contractTemplate)
            $contractTemplate->save();
        else
            $vehicle->contractTemplate()->save($contractTemplate);

        return api_response(trans('vehicle.contract.signature', ['vehicle' => $vehicle->vehicle_name]));
    }
}
