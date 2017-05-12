<?php

namespace Qwikkar\Http\Controllers\API;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;
use Qwikkar\Models\Vehicle;

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
        if (!in_array($request->type, $this->types)) abort(404);

        $this->middleware('client');
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
            'search' => 'required|string',
            'radius' => 'required|numeric',
            'latitude' => 'required|regex:/^(\-?\d+(\.\d+)?)$/',
            'longitude' => 'required|regex:/^(\-?\d+(\.\d+)?)$/',
            'price_min' => 'required|numeric',
            'price_max' => 'required|string',
            'booking_start' => 'required|date',
            'booking_end' => 'required|date',
            'year_min' => 'required|digits:4',
            'year_max' => 'required|digits:4',
        ], [
            'latitude.regex' => 'The latitude is invalid.',
            'longitude.regex' => 'The longitude is invalid.',
        ]);

        $vehicles = Vehicle::where(function (Builder $q) use ($request) {
            $q->orWhere('make', 'like', '%' . $request->search . '%');
            $q->orWhere('model', 'like', '%' . $request->search . '%');
            $q->orWhere('variant', 'like', '%' . $request->search . '%');
        });

        $vehicles->where(function (Builder $q) use ($request) {
            $q->where('rent', '>=', $request->price_min);
            $q->where('rent', '<=', $request->price_max);
        });

        $vehicles->where(function (Builder $q) use ($request) {
            $q->where('year', '>=', $request->year_min);
            $q->where('year', '<=', $request->year_max);
        });

        return $this->filterListRadius(
            $request->radius,
            (object)[
                'lat' => $request->latitude,
                'long' => $request->longitude
            ],
            $vehicles->simplePaginate(5)
        );
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
            'search' => 'required|string',
        ]);

        $vehicles = Vehicle::where(function (Builder $q) use ($request) {
            $q->orWhere('make', 'like', '%' . $request->search . '%');
            $q->orWhere('model', 'like', '%' . $request->search . '%');
            $q->orWhere('variant', 'like', '%' . $request->search . '%');
        });

        $vehicles->select(['id', 'make', 'model', 'variant']);

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
    protected function filterListRadius($radius, $search, $list)
    {
        $list->each(function ($each) use ($search, $radius) {
            $latLong = explode(',', $each->location);
            $distance = $this->distanceGeoPoints($search, (object)['lat' => $latLong[0], 'long' => $latLong[1]]);

            $each->inRadius = $distance <= $radius;
            $each->distance = (float)number_format($distance, 2);
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

        return 6371 * $c;
    }
}
