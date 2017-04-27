<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
}
