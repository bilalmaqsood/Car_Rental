<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Disable timestamps for eloquent
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * Get the users of a type
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_mappings');
    }
}
