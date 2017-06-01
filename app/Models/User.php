<?php

namespace Qwikkar\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'updated_at',
        'created_at',
        'remember_token',
    ];

    /**
     * Get user's balance
     */
    public function balance()
    {
        return $this->hasOne('Qwikkar\Models\Balance');
    }

    /**
     * Relation with Accounts
     */
    public function creditCard()
    {
        return $this->hasMany('Qwikkar\Models\CreditCard');
    }

    /**
     * Relation with Accounts
     */
    public function account()
    {
        return $this->hasMany('Qwikkar\Models\Account');
    }

    /**
     * Relation with OAuth Tokens
     */
    public function oauthTokens()
    {
        return $this->hasMany('Qwikkar\Models\OauthAccessToken');
    }

    /**
     * Relation with client
     */
    public function client()
    {
        return $this->hasOne('Qwikkar\Models\Client');
    }

    /**
     * Relation with owner
     */
    public function owner()
    {
        return $this->hasOne('Qwikkar\Models\Owner');
    }

    /**
     * Get all bookings of vehicle
     */
    public function booking()
    {
        return $this->hasMany('Qwikkar\Models\Booking');
    }

    /**
     * Get all of the promoCodes for the user.
     */
    public function promoCodes()
    {
        return $this->morphToMany('Qwikkar\Models\PromoCode', 'promo_code_able');
    }

    /**
     * Get the types a user has
     */
    public function types()
    {
        return $this->belongsToMany('Qwikkar\Models\UserType', 'user_mappings');
    }

    /**
     * Add the type of a user
     */
    public function addType($id)
    {
        $this->types()->attach($id);
    }

    /**
     * Add the type of a user
     */
    public function removeType($id)
    {
        $this->types()->detach($id);
    }

    /**
     * Add the type of a user
     */
    public function hasType($id)
    {
        return in_array($id, array_column($this->types->toArray(), 'id'));
    }

    /**
     * Find out if User is an client, based on if has any types
     *
     * @return boolean
     */
    public function isClient()
    {
        return in_array('client', array_column($this->types->toArray(), 'name'));
    }

    /**
     * Find out if User is an owner, based on if has any types
     *
     * @return boolean
     */
    public function isOwner()
    {
        return in_array('owner', array_column($this->types->toArray(), 'name'));
    }

    /**
     * Find out if User is an admin, based on if has any types
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return in_array('admin', array_column($this->types->toArray(), 'name'));
    }
}
