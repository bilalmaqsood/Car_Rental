<?php

namespace Qwikkar\Models;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    const DISTANCE_UNIT_KILOMETERS = 111.045;
    const DISTANCE_UNIT_MILES = 69.0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vlc',
        'make',
        'model',
        'variant',
        'year',
        'mileage_service',
        'service_mileage',
        'starting_mileage',
        'mileage',
        'fuel',
        'registration_number',
        'mpg',
        'mpg_eco',
        'transmission',
        'seats',
        'available_from',
        'available_to',
        'pickup',
        'delivery',
        'pickup_location',
        'return_location',
        'location',
        'delivery_charges',
        'rent',
        'insurance',
        'mile_cap',
        'after_mile',
        'deposit',
        'discounts',
        'uber_discount',
        'images',
        'documents',
        'extension',
        'license_years',
        'pco_years',
        'driver_year',
        'license_points',
        'no_fault_accident',
        'fault_accident',
        'notes',
        'pickup_location_title',
        'return_location_title',
        'location_title'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'mpg' => 'float',
        'mpg_eco' => 'float',
        'mileage_service' => 'float',
        'mileage' => 'float',
        'delivery_charges' => 'float',
        'rent' => 'float',
        'insurance' => 'float',
        'mile_cap' => 'float',
        'after_mile' => 'float',
        'deposit' => 'float',

        'year' => 'integer',
        'no_fault_accident' => 'integer',
        'fault_accident' => 'integer',

        'vlc' => 'boolean',
        'pickup' => 'boolean',
        'delivery' => 'boolean',

        'discounts' => 'array',
        'uber_discount' => 'array',
        'images' => 'collection',
        'documents' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'available_from',
        'available_to',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'owner_id',
    ];


    /**
     * The attributes that should be appended to array.
     *
     * @var array
     */
    protected $appends = [
        'is_booked',
        'can_book',
        'tot_booking'
    ];






    /**
     * @param        $query
     * @param        $lat
     * @param        $lng
     * @param int    $radius
     * @param string $units
     *
     * @throws \Exception
     */
    public function scopeNearLatLng( $query, $lat, $lng, $radius = 500, $units = 'K' )
    {
        
        $distanceUnit = $this->distanceUnit( $units );
        
        if ( !( is_numeric( $lat ) && $lat >= -90 && $lat <= 90 ) ) {
            throw new Exception( "Latitude must be between -90 and 90 degrees." );
        }
        
        if ( !( is_numeric( $lng ) && $lng >= -180 && $lng <= 180 ) ) {
            throw new Exception( "Longitude must be between -180 and 180 degrees." );
        }
        
        $haversine = sprintf( '(%f * DEGREES(ACOS(COS(RADIANS(%f)) * COS(RADIANS(SUBSTRING_INDEX(location, ",", 1))) * COS(RADIANS(%f - SUBSTRING_INDEX(location, ",", -1))) + SIN(RADIANS(%f)) * SIN(RADIANS(SUBSTRING_INDEX(location, ",", 1)))))) AS distance',
            $distanceUnit,
            $lat,
            $lng,
            $lat
        );
        
        $subselect = clone $query;
        $subselect->selectRaw( DB::raw( $haversine ) );
        
        // Optimize the query, see details here:
        // http://www.plumislandmedia.net/mysql/haversine-mysql-nearest-loc/
        
        $latDistance = $radius / $distanceUnit;
        $latNorthBoundary = $lat - $latDistance;
        $latSouthBoundary = $lat + $latDistance;
        $subselect->whereRaw( sprintf( "SUBSTRING_INDEX(location, ',', 1) BETWEEN %f AND %f", $latNorthBoundary, $latSouthBoundary ) );
        
        $lngDistance = $radius / ( $distanceUnit * cos( deg2rad( $lat ) ) );
        $lngEastBoundary = $lng - $lngDistance;
        $lngWestBoundary = $lng + $lngDistance;
        $subselect->whereRaw( sprintf( "SUBSTRING_INDEX(location, ',', -1) BETWEEN %f AND %f", $lngEastBoundary, $lngWestBoundary ) );
        $query->from( DB::raw( '(' . $subselect->toSql() . ') as vehicles' ) )
            ->where( 'distance', '<=', $radius );
        //$query->withoutGlobalScope('deleted_at');
    }
    
    
    /**
     * @param string $units
     *
     * @return float
     * @throws \Exception
     */
    private function distanceUnit( $units = 'K' )
    {
        
        if ( $units == 'K' ) {
            return self::DISTANCE_UNIT_KILOMETERS;
        } else if ( $units == 'M' ) {
            return self::DISTANCE_UNIT_MILES;
        } else {
            throw new Exception( "Unknown distance unit measure '$units'." );
        }
    }



    /**

     * Get total bookings on the vehicle.
     *
     * @return boolean if any booking exists for this vehicle
     */
    public function getTotBookingAttribute()
    {
        return $this->booking()->where("status","<",9)->get()->count();
    }


    /**

     * Get the booking status on the vehicle .
     *
     * @return boolean if any booking exists for this vehicle 
     */
    public function getIsBookedAttribute()
    {
        return (bool) $this->booking()->whereIn("status",[4,5,7,8])->count();
    }

    /**

     * Get the booking status on the vehicle .
     *
     * @return boolean if any booking exists for this vehicle
     */
    public function getCanBookAttribute()
    {
        $date = $this->timeSlots()->whereStatus("1")->where("day",">=",Carbon::now()->format("Y-m-d"))->get(["day"])->pluck("day")->first();
        if($date)
            return $date->format("Y-m-d");
        return false;
    }

        /**
     * Get the vehicle's name.
     *
     * @return string
     */
    public function getVehicleNameAttribute()
    {
        return implode(' ', [$this->make, $this->model, $this->variant, $this->year]);
    }

    /**
     * Get the owner of vehicle
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    /**
     * Get all bookings of vehicle
     */
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all time slots of vehicle
     */
    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    /**
     * Get contract template of vehicle
     */
    public function contractTemplate()
    {
        return $this->hasOne(ContractTemplate::class);
    }

    /**
     * Get all of the messages against an vehicle
     */
    public function messages()
    {
        return $this->morphMany(Message::class, 'able');
    }

    /**
     * Inspections of the vehicle
     */
    public function inspection()
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * Get all of the vehicles, an API call of datatables
     */
    public function getDataTableData()
    {
        return \Datatables::of($this->select('vehicles.*'))->get()
            ->addColumn('action', function ($item) {
                return (string)view('admin.vehicles.partials.actions', compact('item'));
            })
            ->make(true);
    }
}
