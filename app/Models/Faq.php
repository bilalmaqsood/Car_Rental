<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'answer',
        'answered_by',
    ];

    /**
     * Get user's record who answered
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }
}
