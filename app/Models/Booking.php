<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'location',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'vehicle_id',
        'user_id',
    ];

    /**
     * Get the vehicle of booking
     */
    public function vehicle()
    {
        return $this->belongsTo('Qwikkar\Models\Vehicle');
    }

    /**
     * Get the vehicle of booking
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
