<?php

namespace Qwikkar\Models;

use Illuminate\Database\Eloquent\Model;
use Qwikkar\Concerns\Couponize;

class PromoCode extends Model
{
    use Couponize;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'reward',
        'is_active',
        'expire_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expire_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expire_at' => 'datetime',

        'is_active' => 'boolean',
        'reward' => 'float',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'updated_at',
    ];

    /**
     * Get all of the users that are assigned to this promo code
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'promo_code_able');
    }

    /**
     * Get all of the bookings that are assigned to this promo code
     */
    public function booking()
    {
        return $this->morphedByMany(Booking::class, 'promo_code_able');
    }
    /**
     * Get all of the promocoes , an API call of datatables
     */
    public function getDataTableData(){
        $query = $this->select("promo_codes.*");
        return \Datatables::of($query)->get()
          ->editColumn('is_active', function ($query) {
                return $query->is_active==1?"Active":"In active";
            })
          ->editColumn('action', function ($item) {
                return (string) view("admin.promocode.partials.actions",compact("item"));
            })
          ->make(true);
    }
}
