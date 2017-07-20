<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'status',
        'message',
    ];

    /**
     * Get the user of ticket
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }

    /**
     * Get the return vehicle of ticket
     */
    public function returnVehicle()
    {
        return $this->belongsTo('Qwikkar\Models\ReturnVehicle');
    }
}
