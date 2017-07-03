<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating',
        'note',
    ];

    /**
     * Get the vehicle of booking
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }

    /**
     * Get all bookings of vehicle
     */
    public function booking()
    {
        return $this->belongsTo('Qwikkar\Models\Booking');
    }
}
