<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;
use Qwikkar\Models\TimeSlot;
use Carbon\Carbon;

class BookingContract extends Model
{


    protected $table = 'contracts';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'business_logo',
            'business_name',
            'business_registration_number',
            'business_address',
            'business_email',
            'business_phone',
            'vehicle_registration_number',
            'vehicle_color',
            'vehicle_make',
            'vehicle_model',
            'client_name',
            'client_address',
            'driving',
            'driving_expire_date',
            'pco_number',
            'pco_expiry_date',
            'deposit',
            'deposit_paid_date',
            'start_date',
            'end_date',
            'insurance_company_name',
            'insurance_policy_number',
            'insurance_expiry_date',
            'weekly_rent_cost',
            'Insurance_excess_cost',
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
        // 'deposit' => 'float',
        // 'start_date' => 'datetime',
        // 'end_date' => 'datetime',

        // 'documents' => 'collection',
        // 'signatures' => 'collection',
    ];




}
