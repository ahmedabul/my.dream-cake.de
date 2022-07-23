<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 
class Order extends Model
{
    protected $guard=['id'];
    protected $fillable = [
        'article_id', 'invoice_id', 'ready', 'delivered', 'accept', 'noAccept', 'damaged', 'tryCount' ,'stars', 'reasonCancel', 'adminReaktion', 'customerComment', 'articlePlace',
      ];
      
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    public static function getOrders($date)
    { 
       return getAllOrders($date);
    }
    public static function getOrder($orderId) 
    {
        return DB::table('customers') 
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->select('*','invoices.id as invoiceId', 'orders.id as orderId')
        ->where('orders.id',$orderId)
        ->first();
    }
    public static function allOrders()
    {
        return allOrders();
    }
    public static function research($research) 
    {
        $orders=DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->leftJoin('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->select('*','invoices.id as invoiceId', 'orders.id as orderId', 'orders.created_at as orderDate','delivery_addresses.lastName as lastName','delivery_addresses.firstName as firstName')
        ->where('invoices.id','like',$research.'%')
        ->orWhere('customers.lastName','like',$research.'%')
        ->orderBy('orderDate','desc')
        ->get();
        return ordersStruktur($orders);

    }
    public static function reset() 
    {
        $orders=Order::where('noAccept','1')
        ->orwhere('damaged','1')
        ->get();
        foreach($orders as $order)
        {
            $tryCount=$order->tryCount+1;
            Order::where('id',$order->id)
            ->update([
                'ready'=>'0',
                'delivered'=>'0',
                'noAccept'=>'0',
                'damaged'=>'0',
                'tryCount'=>$tryCount
            ]);
            Invoice::where('id',$order->invoice_id)
            ->update([
                'driver_id'=>null
            ]);
        }
  
    }
}
