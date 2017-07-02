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
        'mileage',
        'fuel',
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
        'mileage' => 'float',
        'delivery_charges' => 'float',
        'rent' => 'float',
        'insurance' => 'float',
        'mile_cap' => 'float',
        'after_mile' => 'float',
        'deposit' => 'float',
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
        return $this->belongsTo('Qwikkar\Models\Owner');
    }

    /**
     * Get all bookings of vehicle
     */
    public function booking()
    {
        return $this->hasMany('Qwikkar\Models\Booking');
    }

    /**
     * Get all time slots of vehicle
     */
    public function timeSlots()
    {
        return $this->hasMany('Qwikkar\Models\TimeSlot');
    }
}
