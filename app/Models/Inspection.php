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
        'type',
        'data',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'booking_id',
    ];

    /**
     * Get the booking of inspection
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
