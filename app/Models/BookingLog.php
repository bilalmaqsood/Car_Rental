<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class BookingLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requested_data',
        'requested_note',
        'requested_time',

        'fulfilled_data',
        'fulfilled_note',
        'fulfilled_time',

        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'requested_data' => 'array',
        'fulfilled_data' => 'array',

        'requested_time' => 'datetime',
        'fulfilled_time' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'fulfilled_id',
        'requested_id',
        'booking_id',
    ];

    /**
     * Get user of the booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the requested user of booking status
     */
    public function requested()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the fulfilled user of booking status
     */
    public function fulfilled()
    {
        return $this->belongsTo(User::class);
    }
}
