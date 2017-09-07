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

            if ($key == 'rating') {

                $vehicles = Vehicle::leftjoin('feedback', 'feedback.user_id', '=', 'vehicles.owner_id')
                    ->select(array('vehicles.*',
                        \DB::raw('AVG(feedback.rating) as ratings_average')
                    ))
                    ->groupBy('vehicles.id')
                    ->orderBy("ratings_average", $value)
                    ->paginate(12);
            }



             else

            $vehicles = Vehicle::orderBy($key, $value)->paginate(12);

            return api_response($vehicles);
        }

        return api_response(Vehicle::paginate(12));
    }

    public function TermsConditions()
    {
       return view("terms.index");
    }
}
