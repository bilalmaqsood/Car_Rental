<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;
use Qwikkar\Models\TimeSlot;

class Booking extends Model
{
    /**
     * Booking statuses
     *
     * @var array
     */
    public $statusTypes = [
        'Requested',
        'Approved',
        'Signed by client',
        'Signed by owner',
        'Accepted',
        'Termination',
        'Terminated',
        'Extend',
        'Extended',
        'Close',
        'Disputed',
        'Resolved',
        'Deposit Returned'
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
     * Get all the timeslots of the vehicle.
     */
    public function timeslots()
    {
        return $this->hasMany(TimeSlot::class);
    }

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

    /**
     * Get all of the booking  for the datatable listing.
     */
    public function getDataTableData()
    {
        return \Datatables::of($this->select('bookings.*')
            ->with('user', 'vehicle'))->get()
            ->addColumn('vehicle', function ($query) {
                return $query->vehicle->make . ' ' . $query->vehicle->model;
            })
            ->addColumn('status', function ($query) {
                return $this->statusTypes[$query->status];
            })
            ->addColumn('promo_code', function ($query) {
                $code = $query->promoCodes()->first();
                return isset($code) ? $code->code : '';
            })
            ->addColumn('action', function ($item) {
                return (string)view('admin.booking.partials.actions', compact('item'));
            })
            ->editColumn('start_date', function ($query) {
                return $query->start_date->format('d M Y');
            })
            ->editColumn('end_date', function ($query) {
                return $query->end_date->format('d M Y');
            })
            ->make(true);
    }
}
