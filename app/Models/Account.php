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
     * Set the account number.
     *
     * @param  string $value
     * @return void
     */
    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = encrypt($value);
    }

    /**
     * Get the account number.
     *
     * @param  string $value
     * @return string
     */
    public function getNumberAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * Set the account number.
     *
     * @param  string $value
     * @return void
     */
    public function setSortcodeAttribute($value)
    {
        $this->attributes['sortcode'] = encrypt($value);
    }

    /**
     * Get the account number.
     *
     * @param  string $value
     * @return string
     */
    public function getSortcodeAttribute($value)
    {
        return decrypt($value);
    }

    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
