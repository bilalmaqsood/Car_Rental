<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class BookingReminder extends Model
{
    protected $fillable = [
        "owner_id",
        "client_id",
        "booking_id"
    ];
}
