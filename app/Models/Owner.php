<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'town',
        'street',
        'company',
        'address',
        'country',
        'postcode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'user_id',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $appends = [
        'avg_rating',
    ];


    /**
     * Get the booking status on the vehicle .
     *
     * @return boolean if any booking exists for this vehicle
     */
    public function getAvgRatingAttribute()
    {
        return $this->user->rating->avg("rating");
    }


    /**
     * Get the vehicle of owner
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Get the user of owner profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
