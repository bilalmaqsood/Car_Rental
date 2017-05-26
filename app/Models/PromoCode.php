<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;
use Qwikkar\Concerns\Couponize;

class PromoCode extends Model
{
    use Couponize;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'reward',
        'is_active',
        'expire_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expire_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expire_at' => 'datetime',

        'is_active' => 'boolean',
        'reward' => 'float',
    ];

    /**
     * Get all of the users that are assigned to this promo code
     */
    public function users()
    {
        return $this->morphedByMany('Qwikkar\Models\User', 'promo_codeable');
    }

    /**
     * Get all of the bookings that are assigned to this promo code
     */
    public function booking()
    {
        return $this->morphedByMany('Qwikkar\Models\Booking', 'promo_codeable');
    }
}
