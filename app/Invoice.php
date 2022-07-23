<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Invoice extends Model
{
    protected $guard=['id'];
    protected $fillable = [
        'delivery_address_id' , 'driver_id'
      ];
    public function delivery_address()
    {
        return $this->belongsTo('App\Delivery_address');
    }
    public function order()
    {
        return $this->hasMany('App\Order');
    }
    public function drivrer()
    {
        $this->belongsTo('App\Driver');
    }
    public static function getInvoices($customerId) 
    {
       return getCustomerInvoicess($customerId); 
    }
}
