<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $guard = 'customer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastName','firstName','email','password','remember_token', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function checkEmail($email)
    {
       if(!empty(Customer::where('email',$email)->first()->email))
       {
           return true;
       }
    }

    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }
    public function delivery_address()
    {
        return $this->hasMany('App\Delivery_address');
    }
    public static function getMyOrder($orderId)
    { 
       return getCustomerOrder($orderId);
    }

}
