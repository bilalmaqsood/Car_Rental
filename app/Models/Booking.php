<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;
use Qwikkar\Models\TimeSlot;
use Carbon\Carbon;

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
     * The attributes that should be appended to array.
     *
     * @var array
     */
    protected $appends = [
        'handover_inspection',
        'booking_amended'
    ];

    /**
     * Open handover inspection before 24 hours of booking
     * 
     */

    public function getHandoverInspectionAttribute(){
        return true;
        return  $this->start_date > Carbon::now() && $this->start_date->diffInHours(Carbon::now()) <= 24;
    }
    /**
     * Open handover inspection before 24 hours of booking
     * 
     */

    public function getBookingAmendedAttribute(){
        return  $this->inspections()->where("status",BOOKING_AMENDED)->count() >= 1;
    }


    /**
     * All the booking that are requested
     * 
     */
    public static function scopeBookingRequests($query)
    {
        return $query->whereStatus(BOOKING_REQUESTED);
    }
    
    
    
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
     * Get all the reminders on the bookings
     *
     */
    public function reminders()
    {
       return  $this->hasMany(BookingReminder::class);
    }

    /**
     * Get all the inspections on the bookings
     *
     */
    public function inspections()
    {
       return  $this->hasMany(Inspection::class);
    }

    /**
     * Get booking confirmation code
     *
     */
    public function code()
    {
       return  $this->hasOne(InspectionConfirmation::class);
    }


    /**
     * Get the contract template data on the booking
     *
     */
    public function contract()
    {
       return  $this->hasMany(BookingContract::class);
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
