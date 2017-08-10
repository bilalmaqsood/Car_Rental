<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'make',
        'model',
        'variant',
        'year',
        'mileage_service',
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
    ];



    /**
     * Get the booking status on the vehicle .
     *
     * @return boolean if any booking exists for this vehicle 
     */
    public function getIsBookedAttribute()
    {
        return (bool) $this->booking()->count();
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
     * Get all of the vehicles , an API call of datatables
     */
    public function getDataTableData(){
        $query = $this->select("vehicles.*");
        return \Datatables::of($query)->get()
          ->addColumn('action', function ($item) {
                return (string) view("admin.vehicles.partials.actions",compact("item"));
            })
          ->make(true);
    }
}
