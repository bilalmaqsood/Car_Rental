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
        'pco_number',
        'pco_release_date',
        'pco_expiry_date',
        'documents',
        'status',
        'dlc',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dlc' => 'boolean',

        'documents' => 'collection',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'dob',
        'pco_release_date',
        'pco_expiry_date',
    ];

    /**
     * Get the user of client
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
