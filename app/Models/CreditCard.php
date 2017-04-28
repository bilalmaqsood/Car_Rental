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
        'address',
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
        return decrypt($value);
    }

    /**
     * Set the credit card expiry date.
     *
     * @param  string $value
     * @return void
     */
    public function setExpiryAttribute($value)
    {
        $this->attributes['expiry'] = encrypt($value);
    }

    /**
     * Get the credit card expiry date.
     *
     * @param  string $value
     * @return string
     */
    public function getExpiryAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * Set the credit card address.
     *
     * @param  string $value
     * @return void
     */
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = encrypt($value);
    }

    /**
     * Get the credit card address.
     *
     * @param  string $value
     * @return string
     */
    public function getAddressAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * Get the user of credit card
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
