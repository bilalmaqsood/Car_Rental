<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionConfirmation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id',
        'confirm_code',
        'status',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}
