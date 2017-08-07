<?php

namespace Qwikkar\Http\Controllers;

use Illuminate\Http\Request;
use Qwikkar\Models\Vehicle;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Get top vehicles
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function topVehicles(Request $request)
    {
        $data = $request->all();

        if (count($data)) {
            $key = key($data);
            $value = $data[$key];

            if ($key == 'rating')
                throw new NotFoundHttpException();

            return api_response(Vehicle::orderBy($key, $value)->get()->take(10));
        }

        return api_response(Vehicle::all());
    }
}
