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
     * Get the return vehicle of ticket
     */
    public function returnVehicle()
    {
        return $this->belongsTo(ReturnVehicle::class);
    }

        /**
     * Get all of the tickets , an API call of datatables
     */
    public function getDataTableData(){
        $query = $this->select("tickets.*");
        return \Datatables::of($query)->get()
          ->make(true);
    }
}
