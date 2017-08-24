<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Vehicle;
use Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Search types for application
     */
    protected $types = ['vehicle', 'address', 'make-model'];

    /**
     * SearchController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if (!in_array($request->type, $this->types)) {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Search for vehicles with different types
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $results = [];
        switch ($request->type) {
            case 'vehicle':
                $results = $this->getVehicleResults($request);
                break;
            case 'address':
                $results = $this->getAddressResults($request);
                break;
            case 'make-model':
                $results = $this->getMakeModelResults($request);
                break;
        }

        return api_response($results);
    }

    /**
     * Search Vehicles with radial search and filters
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Pagination\Paginator
     */
    protected function getVehicleResults(Request $request)
    {
        $this->validate($request, [
            'vehicle' => 'string',
            'radius' => 'numeric',
            'latitude' => 'regex:/^(\-?\d+(\.\d+)?)$/',
            'longitude' => 'regex:/^(\-?\d+(\.\d+)?)$/',
            'price_min' => 'numeric',
            'price_max' => 'string',
            'booking_start' => 'date',
            'booking_end' => 'date',
            'year_min' => 'digits:4',
            'year_max' => 'digits:4',
        ], [
            'latitude.regex' => 'The latitude is invalid.',
            'longitude.regex' => 'The longitude is invalid.',
        ]);

        $vehicles = Vehicle::select('id', 'make', 'model', 'variant', 'year', 'mileage', 'seats', 'fuel', 'mpg', 'transmission', 'rent', 'location', 'available_from', 'available_to', 'images', 'created_at')->where('vlc', 1);

        if ($request->has('vehicle') && $request->vehicle != '||_||')
            $vehicles = $vehicles->where(function (Builder $q) use ($request) {
                $q->whereRaw('TRIM(BOTH \' \' FROM CONCAT_WS(\' \', `make`, `model`, `variant`, `year`)) like ?', ['%' . $request->vehicle . '%']);
//                $q->orWhere('make', 'like', '%' . $request->search . '%');
//                $q->orWhere('model', 'like', '%' . $request->search . '%');
//                $q->orWhere('variant', 'like', '%' . $request->search . '%');
            });

        if ($request->has('booking_start') && $request->has('booking_end'))
            $vehicles = $vehicles->where(function (Builder $q) use ($request) {
                $q->where('available_from', '<=', Carbon::parse($request->booking_start));
                $q->where('available_to', '>=', Carbon::parse($request->booking_end));
            });

        $vehicles->where(function (Builder $q) use ($request) {

            if ($request->price_min)
                $q->where('rent', '>=', $request->price_min);

            if ($request->price_max)
                $q->where('rent', '<=', $request->price_max);

            if ($request->price)
                $q->where('rent', '<=', $request->price);
        });

        $vehicles->where(function (Builder $q) use ($request) {

            if ($request->year_min)
                $q->where('year', '>=', $request->year_min);

            if ($request->year_max)
                $q->where('year', '<=', $request->year_max);
        });

        $vehicles->with(['booking' => function ($with) {
            $with->select('id', 'vehicle_id', 'start_date', 'end_date');
            // $with->where('status', 2); // accepted booking from owner
        }]);

        $vehicles->orderBy('created_at', 'desc');

        $vehiclesList = $vehicles->paginate(30);

        if ($request->latitude && $request->longitude)
            $vehiclesList = $this->filterListRadius(
                $request->radius?: 5,
                (object)[
                    'lat' => $request->latitude,
                    'long' => $request->longitude
                ],
                $vehiclesList
            );
        // $vehiclesList= new \Illuminate\Pagination\LengthAwarePaginator($vehiclesList,$vehiclesList->count(),10);
        return $vehiclesList;
    }

    /**
     * Auto complete for address
     *
     * @param Request $request
     * @return array
     */
    protected function getAddressResults(Request $request)
    {
        return $request->all();
    }

    /**
     * Search Vehicles for specific make and model
     *
     * @param Request $request
     * @return array
     */
    protected function getMakeModelResults(Request $request)
    {
        $this->validate($request, [
            'vehicle' => 'required|string',
        ]);

        $vehicles = Vehicle::select(['id', 'make', 'model', 'variant']);

        if ($request->has('vehicle') && $request->vehicle != '||_||')
            $vehicles->where(function (Builder $q) use ($request) {
                $q->orWhere('make', 'like', '%' . $request->vehicle . '%');
                $q->orWhere('model', 'like', '%' . $request->vehicle . '%');
                $q->orWhere('variant', 'like', '%' . $request->vehicle . '%');
            });

        return $vehicles->get();
    }

    /**
     * Filter the list according to radius
     *
     * @param $radius
     * @param $search
     * @param $list
     * @return mixed
     */
    protected function filterListRadius($radius=5, $search, $list)
    {
        $list->each(function (&$each,$key) use (&$list, $search, $radius) {
            $latLong = explode(',', $each->location);

            if (count($latLong) == 2) {
                $distance  = (int) $this->distanceGeoPoints($search, (object)['lat' => $latLong[0], 'long' => $latLong[1]]);
               if($distance > $radius){
                   $list->forget($key);
               }
                

            }
        });

        return $list;
    }

    /**
     * Get the distance of two places
     *
     * @param $search
     * @param $find
     * @return int
     */
    protected function distanceGeoPoints($search, $find)
    {
        $lat = deg2rad($find->lat - $search->lat);
        $long = deg2rad($find->long - $search->long);

        $a = sin($lat / 2) * sin($lat / 2) + cos(deg2rad($search->lat)) * cos(deg2rad($find->lat)) * sin($long / 2) * sin($long / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return 3956  * $c;
        // return 6371 * $c;
    }
}
