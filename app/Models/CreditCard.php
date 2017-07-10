<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'number',
        'expiry',
        'cvc',
        'address',
        'default',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'default' => 'integer',
    ];

    /**
     * Set the credit card number.
     *
     * @param  string $value
     * @return void
     */
    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = encrypt($value);
    }

    /**
     * Get the credit card number.
     *
     * @param  string $value
     * @return string
     */
    public function getNumberAttribute($value)
    {
        return $value ? decrypt($value) : '';
    }

    /**
     * Get the credit card number.
     *
     * @return string
     */
    public function getLastNumbersAttribute()
    {
        return substr($this->number, -4);
    }

    /**
     * Set the credit card expiry date.
     *
     * @param  string $value
     * @return void
     */
    public function setExpiryAttribute($value)
    {
        $this->attributes['expiry'] = $value ? encrypt($value) : '';
    }

    /**
     * Get the credit card expiry date.
     *
     * @param  string $value
     * @return string
     */
    public function getExpiryAttribute($value)
    {
        return $value ? decrypt($value) : '';
    }

    /**
     * Set the credit card address.
     *
     * @param  string $value
     * @return void
     */
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = $value ? encrypt($value) : '';
    }

    /**
     * Get the credit card address.
     *
     * @param  string $value
     * @return string
     */
    public function getAddressAttribute($value)
    {
        return $value ? decrypt($value) : '';
    }

    /**
     * Set the credit card cvc number.
     *
     * @param  string $value
     * @return void
     */
    public function setCvcAttribute($value)
    {
        $this->attributes['cvc'] = $value ? encrypt($value) : '';
    }

    /**
     * Get the credit card cvc number.
     *
     * @param  string $value
     * @return string
     */
    public function getCvcAttribute($value)
    {
        return $value ? decrypt($value) : '';
    }

    /**
     * Get the user of credit card
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
