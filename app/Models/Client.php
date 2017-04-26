<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'insurance',
        'postcode',
        'driving',
        'dvla',
        'dob',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'dob',
    ];

    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
