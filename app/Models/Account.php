<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'number',
        'default',
        'sortcode',
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
        'default'
    ];

    /**
     * Set the account number.
     *
     * @param  string $value
     * @return void
     */
    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = $value ? encrypt($value) : '';
    }

    /**
     * Get the account number.
     *
     * @param  string $value
     * @return string
     */
    public function getNumberAttribute($value)
    {
        return $value ? decrypt($value) : '';
    }

    /**
     * Set the account number.
     *
     * @param  string $value
     * @return void
     */
    public function setSortcodeAttribute($value)
    {
        $this->attributes['sortcode'] = $value ? encrypt($value) : '';
    }

    /**
     * Get the account number.
     *
     * @param  string $value
     * @return string
     */
    public function getSortcodeAttribute($value)
    {
        return $value ? decrypt($value) : '';
    }

    /**
     * Get the user of account
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
