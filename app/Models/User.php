<?php

namespace Qwikkar\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yajra\Datatables\Datatables;
use Laravel\Passport\HasApiTokens;
use Qwikkar\Concerns\Balanceable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Balanceable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'email',
        'phone',
        'postcode',
        'device_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'updated_at',
        'created_at',
        'remember_token',
    ];

    /**
     * encrypt password for user.
     *
     * @param  string $value
     * @return void
     */
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    /**
     * Get the user's current balance.
     *
     * @return float
     */
    public function getCurrentBalanceAttribute()
    {
        return $this->balance ? $this->balance->current : 0;
    }

    /**
     * Get user's messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Get user's frequently asked questions
     */
    public function faq()
    {
        return $this->hasMany(Faq::class, 'answered_by');
    }

    /**
     * Get user's balance
     */
    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    /**
     * Get all of the balance logs for the booking.
     */
    public function balanceLogs()
    {
        return $this->morphMany(BalanceLog::class, 'loggable');
    }

    /**
     * Relation with Accounts
     */
    public function creditCard()
    {
        return $this->hasMany(CreditCard::class);
    }

    /**
     * Relation with Accounts
     */
    public function withdraw()
    {
        return $this->hasMany(Withdraw::class);
    }

    /**
     * Relation with Accounts
     */
    public function account()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Relation with OAuth Tokens
     */
    public function oauthTokens()
    {
        return $this->hasMany(OauthAccessToken::class);
    }

    /**
     * Relation with client
     */
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Relation with owner
     */
    public function owner()
    {
        return $this->hasOne(Owner::class);
    }

    /**
     * Get all bookings of vehicle
     */
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get all of the promoCodes for the user.
     */
    public function promoCodes()
    {
        return $this->morphToMany(PromoCode::class, 'promo_code_able');
    }

    /**
     * Get the types a user has
     */
    public function types()
    {
        return $this->belongsToMany(UserType::class, 'user_mappings');
    }

    /**
     * Add the type of a user
     */
    public function addType($id)
    {
        $this->types()->attach($id);
    }

    /**
     * Add the type of a user
     */
    public function removeType($id)
    {
        $this->types()->detach($id);
    }

    /**
     * Add the type of a user
     */
    public function hasType($id)
    {
        return in_array($id, array_column($this->types->toArray(), 'id'));
    }

    /**
     * Find out if User is an client, based on if has any types
     *
     * @return boolean
     */
    public function isClient()
    {
        return in_array('client', array_column($this->types->toArray(), 'name'));
    }

    /**
     * Find out if User is an owner, based on if has any types
     *
     * @return boolean
     */
    public function isOwner()
    {
        return in_array('owner', array_column($this->types->toArray(), 'name'));
    }

    /**
     * Find out if User is an admin, based on if has any types
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return in_array('admin', array_column($this->types->toArray(), 'name'));
    }

    /**
     * Find out if User is an admin, based on if has any types
     *
     * @return boolean
     */
    public function rating()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function getDataTableData()
    {
        $query = $this->select("users.*");
        return Datatables::of($query)->get()
            ->addColumn('user_type', function ($query) {
                return $query->types->first()->name;
            })
            ->addColumn('status', function ($user) {
                if($user->client)
                    return $user->client->status==1?"<label class='label label-danger'>Disputed</label>" : "<label class='label label-success'>Ok</label>";
                return "";
                // return (string)view('admin.users.partials.actions', compact('user'));
            })
            ->addColumn('action', function ($user) {
                return (string)view('admin.users.partials.actions', compact('user'));
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

}
