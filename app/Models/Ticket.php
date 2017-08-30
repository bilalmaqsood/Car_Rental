<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'status',
        'message',
    ];

    /**
     * Get the user of ticket
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the driver of the vehicle
     */
    public function client()
    {
        return $this->belongsTo(User::class,"client_id");
    }

    /**
     * Get the inspection of ticket
     */
    public function inspection()
    {
        return $this->belongsTo(Inspection::class);
    }

    /**
     * Get all of the tickets, an API call of datatables
     */
    public function getDataTableData()
    {
        return \Datatables::of($this->select("tickets.*"))->get()->make(true);
    }
}
