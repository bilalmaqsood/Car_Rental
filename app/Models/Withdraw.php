<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'note',
    ];

    /**
     * Get the user of withdraw
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }

    /**
     * Get all of the balance logs for the withdraws.
     */
    public function balanceLogs()
    {
        return $this->morphMany('Qwikkar\Models\BalanceLog', 'loggable');
    }
}
