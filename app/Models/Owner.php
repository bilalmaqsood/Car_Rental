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

    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
