<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cost',
        'paid',
        'title',
        'due_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cost' => 'float',

        'paid' => 'boolean',

        'due_date' => 'datetime',
    ];

    /**
     * Get user of the booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get all of the balance logs for the booking.
     */
    public function balanceLogs()
    {
        return $this->morphMany(BalanceLog::class, 'loggable');
    }
}
