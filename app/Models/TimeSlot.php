<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'day',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'day',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'vehicle_id',
    ];

    /**
     * Get the vehicle of time slot
     */
    public function vehicle()
    {
        return $this->belongsTo('Qwikkar\Models\Vehicle');
    }
}
