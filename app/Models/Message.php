<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'read',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'read' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'sender_id',
        'receiver_id',
    ];

    /**
     * Get the ables of the message
     */
    public function able()
    {
        return $this->morphTo();
    }

    /**
     * Get the sender user of message
     */
    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the receiver user of message
     */
    public function receiver()
    {
        return $this->belongsTo(User::class);
    }
}
