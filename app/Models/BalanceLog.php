<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'comment',
        'payment_response',
        'booking_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'float',
    ];

    /**
     * Get the logs of the balance
     */
    public function loggable()
    {
        return $this->morphTo();
    }

    /**
     * Get user of the balance
     */
    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }
}
