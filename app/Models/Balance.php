<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'current',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'current' => 'float',
    ];

    /**
     * Get user of the balance
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }

    /**
     * Get the logs of the balance
     */
    public function logs()
    {
        return $this->hasMany('Qwikkar\Models\BalanceLog');
    }
}
