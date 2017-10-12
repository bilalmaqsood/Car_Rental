<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Socket extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'collection',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'key_value';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'echo-server';
}
