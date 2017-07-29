<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * Booking statuses
     *
     * @var array
     */
    public $statusTypes = [
        'Requested',
        'Confirmed',
        'Signed by client',
        'Signed by owner',
        'Accepted',
        'Termination',
        'Terminated',
        'Extend',
        'Extended',
        'Close',
        'Disputed',
        'Resolved'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'location',
        'deposit',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deposit' => 'float',
        'start_date' => 'datetime',
        'end_date' => 'datetime',

        'documents' => 'collection',
        'signatures' => 'collection',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'vehicle_id',
        'user_id',
    ];

    /**
     * Get all of the balance logs for the withdraws.
     */
    public function messages()
    {
        return $this->morphMany(Message::class, 'able');
    }

    /**
     * Get user of the booking
     */
    public function bookingLog()
    {
        return $this->hasMany(BookingLog::class);
    }

    /**
     * Get the account of the booking
     */
    public function account()
    {
        return $this->morphTo();
    }

    /**
     * Get user of the booking
     */
    public function payments()
    {
        return $this->hasMany(BookingPayment::class);
    }

    /**
     * Get all inspections of the booking vehicle
     */
    public function inspection()
    {
        return $this->hasMany(Inspection::class);
    }

    /**
     * Get all return vehicle inspections of the booking vehicle
     */
    public function returnVehicle()
    {
        return $this->hasMany(ReturnVehicle::class);
    }

    /**
     * Get the vehicle of booking
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the vehicle of booking
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the promoCodes for the booking.
     */
    public function promoCodes()
    {
        return $this->morphToMany(PromoCode::class, 'promo_code_able');
    }
}
