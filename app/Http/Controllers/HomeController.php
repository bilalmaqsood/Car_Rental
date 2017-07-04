<?php

namespace Qwikkar\Http\Controllers;

use Illuminate\Http\Request;
use Qwikkar\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['search','topVehicles']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function search()
    {
        return view('search.index');
    }

    public function topVehicles(Request $request)
    {
        $data = $request->toArray();
        if(count($data)){
            $key = key($data);
            $value = $data[$key];
            return api_response(Vehicle::orderBy($key,$value)->get());
        }
        return api_response(Vehicle::all());
    }
}
