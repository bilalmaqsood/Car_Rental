<?php

namespace Qwikkar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Qwikkar\Models\Vehicle;
use Qwikkar\Http\Requests\VehicleModel;
use Qwikkar\Http\Controllers\Controller;

class VehiclesController extends Controller
{
    /**
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if(request()->ajax())
        {

           $vehicle = new Vehicle();

            return $vehicle->getDataTableData();
        }
        return view("admin.vehicles.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        return view("admin.vehicles.show",compact("vehicle"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        return view("admin.vehicles.edit",compact("vehicle"));

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
        $vehicle = Vehicle::where('id', $id)->first();

        if (!$vehicle) throw new ModelNotFoundException();

        $vehicle->fill($request->except(['available_from',
        'available_to']));

        $vehicle->save();

        return api_response($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $status = Vehicle::destroy($id);

        if(request()->ajax())
        {

            return response()->json([
                'success' => $status == 1 ? 'true' : 'false'
            ]);
        }

    }
}
