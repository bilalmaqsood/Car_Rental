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
    {   $tot_vehicles=null;
        if(auth()->check())
        $tot_vehicles = request()->user()->isOwner()?request()->user()->owner->vehicles->count():null;
        return view('welcome',compact("tot_vehicles"));
    }

    /**
     * Get top vehicles
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function topVehicles(Request $request)
    {
        $data = $request->except('page');

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
                    ->paginate(6);
            } else if($key=='location'){
                $vehicles = Vehicle::select('id', 'make', 'model', 'variant', 'year', 'mileage', 'seats', 'fuel', 'mpg', 'transmission', 'rent', 'location', 'available_from', 'available_to', 'images', 'created_at','vlc');

                if ($request->latitude && $request->longitude)
                    $vehicles = $vehicles->NearLatLng($request->latitude,$request->longitude,$request->radius?: 1000);

                $vehicles->orderBy('distance', 'asc');

                $vehiclesList = $vehicles->where('vlc', 1)->paginate(30);

                return api_response($vehiclesList);
            }
             else

            $vehicles = Vehicle::orderBy($key, $value)->paginate(6);
            $vehicles->appends(request()->except('page'))->links();
            return api_response($vehicles);
        }

        return api_response(Vehicle::paginate(6));
    }

    public function allVehicles()
    {
       return api_response(Vehicle::all());
    }

    public function TermsConditions()
    {
       return view("terms.index");
    }
}
