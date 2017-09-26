<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'is_return',
        'type',
        'x_axis',
        'y_axis',
        'path',
        'note',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_return' => 'boolean',

        'x_axis' => 'integer',
        'y_axis' => 'integer',
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
     * Get the vehicle of inspection
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Relation to ticket table
     */
    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}
