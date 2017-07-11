<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class ContractTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_signature',
        'template',
    ];

    /**
     * Get the vehicle of contract template
     */
    public function vehicle()
    {
        return $this->belongsTo('Qwikkar\Models\Vehicle');
    }
}
