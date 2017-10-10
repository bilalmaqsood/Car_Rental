<?php

namespace Qwikkar\Models;

use Carbon\Carbon;
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
        'discount'
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

    protected $appends = ['overdue'];
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

    public function getOverdueAttribute($value)
    {
        return $this->paid==false && $this->due_date < \Carbon\Carbon::now();
    }

    /**
     * Query scope to get all due payments
     */
    public function scopeDuePayment($query)
    {
        return $query->where("due_date","<=",Carbon::now())->where("paid",0);
    }

}
