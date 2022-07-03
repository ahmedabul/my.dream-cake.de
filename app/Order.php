<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 
class Order extends Model
{
    protected $guard=['id'];
    protected $fillable = [
        'article_id', 'invoice_id', 'articleCount', 'toDeliverCount', 'deliveredCount', 'stars', 'customerAccept',	'demagedArticle', 'yesAcceptCount', 'noAcceptCount', 'demagedAcceptCount', 'cancelDecision', 'reasonCancel', 'adminReaktion', 'cancelCount', 'customerComment', 'articlePlace',
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
    public static function returnOrders()
    {
        return returnOrders();
    }
    public static function research($research) 
    {
        $orders=DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->leftJoin('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->select('*','invoices.id as invoiceId', 'orders.id as orderId', 'orders.created_at as orderDate','delivery_addresses.lastName as daLastName','delivery_addresses.firstName as daFirstName')
        ->where('invoices.id','like',$research.'%')
        ->orWhere('customers.lastName','like',$research.'%')
        ->orderBy('orderDate','desc')
        ->get();
        return ordersStruktur($orders);

    }
}
