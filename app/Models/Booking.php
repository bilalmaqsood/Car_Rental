<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * Booking statuses
     *
     * @var array
     */
    public $statusTypes = [
        'Requested',
        'Confirmed',
        'Accepted',
        'Cancel',
        'Canceled',
        'Extend',
        'Extended'
    ];

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
     * Get user of the booking
     */
    public function bookingLog()
    {
        return $this->hasMany('Qwikkar\Models\BookingLog');
    }

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

    /**
     * Get all of the promoCodes for the booking.
     */
    public function promoCodes()
    {
        return $this->morphToMany('Qwikkar\Models\PromoCode', 'promo_code_able');
    }

    /**
     * Get all of the balance logs for the booking.
     */
    public function balanceLogs()
    {
        return $this->morphMany('Qwikkar\Models\BalanceLog', 'loggable');
    }
}
