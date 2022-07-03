<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_address extends Model
{
    protected $guard=['id'];
    protected $fillable = [
    'lastName', 'firstName', 'city', 'street', 'hausNr', 'plz', 'customer_id' 
      ];
    public function customer()
    {
        return $this->belongsTo('App\Customert');
    }
    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }
    public static function getAdresses($customerId)
    {
     return Delivery_address::where('customer_id',$customerId)->get();
    }
}
