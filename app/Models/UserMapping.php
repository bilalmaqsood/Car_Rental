<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class UserMapping extends Model
{
    /**
     * Disable timestamps for eloquent
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * Get the types a user has
     */
    public function user()
    {
        return $this->belongsTo('Qwikkar\Models\User');
    }
}
