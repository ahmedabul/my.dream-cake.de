<?php

namespace App\Http\Controllers;

use App\Delivery_address; 
use App\Driver;
use App\Invoice;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class orderController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('customer')->except(['checkLogin','index','cancel','deliver','cancelForm','ordersToDrivers','orderDriverSave','return','goToResearch','research','show','unlock']);
    }
    public function checkLogin(Request $request) 
    {
        $articlesCount=countArticlesImCart();
        $articles=articlesImCart();
        if(Auth::guard('admin')->check())
        {
            return ['type'=>'admin'];
        }
        elseif(Auth::guard('customer')->check())
        {
            return ['type'=>'customer','articlesCount'=>$articlesCount,'articles'=>$articles];
        }
        else{
            return ['type'=>'noCustomer'];
        }
    }
    public function pay($deliveryAddressId)
    {
        $articles=articlesImCart();
        $deliveryAddress=Delivery_address::find($deliveryAddressId);
        if(empty($deliveryAddress))
        {
            return view('error.error',['sts'=>'Fehler Meldung']);
        }
        return view('order.pay',compact('articles'),['deliveryAddress'=>$deliveryAddress]);
      
    }
    public function create($deliveryAddressId)
    {
        //Create Invoice 
        Invoice::create([ 
            'delivery_address_id'=>$deliveryAddressId,
        ]);
        //Create Order
        createOrder();
        //Get all Orders of the Customer, hwo ordered
        $orders= getCustomerInvoicess(Auth::guard('customer')->user()->id);
        //Get from his all Orders just the last Order
        $orders=last($orders);
        //Send to Customer Thanksemail for Order, with Variable 'orders' to show the new Orders
        sendTanksOrderEmail($orders);
        //Empty Session 'articles
        unset($_SESSION['cartArticles']);
        return view('order.create',compact('orders'));
    
    }
    public function index($date)
    { 
        //Get all Invoices at the $date 'After3Days, Aftertomowrro, Tomowrro or Today'
        $invoices=Order::getOrders($date); 
        //Get the Title at the date 'After3Days Aftertomowrro Tomowrro Today'
        $indexTitle=orderIndexTitle($date);
        //Return view 'order.index', invoices and Title of the Index
        return view('order.index',compact('invoices'),['indexTitle'=>$indexTitle]);
    }
    public function cancel(Request $request)
    {
        //Validation
        if(empty($request->reasonCancel) or empty($request->adminReaktion) or empty($request->cancelCount))
        {
            return redirect()->back()->with(['reasonCancel'=>$request->reasonCancel, 'adminReaktion'=>$request->adminReaktion, 'sts'=>'Füllen Sie bitte alle Felder aus']);
        }
        //Get the canceled Order
        $order=Order::getOrder($request->orderId);
        //cancel the Order
        cancelOrder($request->orderId, $request->reasonCancel, $request->adminReaktion, $request->cancelCount);
        //Send Email 'cancelsOrder' to Customer
        cancelOrderEmail($request->email,$order, $request->reasonCancel, $request->adminReaktion);
        //return to Index Admin
        return redirect()->back()->with(['sts'=>'Ein E-Mail wurde erfolgreich gesendet']);
    }
    public function cancelForm($orderId,$email)
    {
        $order=Order::find($orderId);
        return view('order.cancelForm',compact('order'),['email'=>$email]);
    }
  
    public function deliver(Request $request)
    {
        //Get the Order
        $order=Order::getOrder($request->orderId);
        //Set orderDelivered=>yes
        Order::where('id',$request->orderId)
        ->update([
            "orderDelivered"=>'yes'
        ]);
        //Send Email 'deliveredOrder'
        dileveredOrderEmail($request->email, $order);
        return ['order'=>$request->orderId];
    }
    //Destroy The Order from DB
    public function destroy(Request $request)
    {
        //Get the canceled Order
        $order=Order::getOrder($request->orderId);
        //Delete the Order at orderId
        Order::destroy([
        'id'=>$request->orderId
        ]);
        //check if The Invoice dose'nt exist any Order
        if((checkInvoice($request->invoiceId)->count() ==0))
        {
            //delete the Invoice if it's empty
            Invoice::destroy([
            'id'=>$request->invoiceId 
            ]);
        }   
    }
    public function ordersToDrivers()
    {
        $invoices=ordersToDrivers();  
        $drivers=Driver::all();
        return view('order.ordersToDrivers',compact(['invoices','drivers'])); 
    }
    public function orderDriverSave(Request $request)
    {
        //Validation
        if(empty($request->driverId))
        {
            return redirect()->back()->with(['invoiceId'=>$request->invoiceId,'stsError'=>'Wählen Sie einen Fahrer aus']);
        }
        //set the DriverId
        Invoice::where('id',$request->invoiceId)
        ->update([
            'driver_id'=>$request->driverId, 
        ]);
        if(!empty($request->orderIds))
        {  
            foreach($request->orderIds as $orderids =>$orderId)
            {
                $toDeliverCount=toDeliverCount($orderId);
                $order=Order::getOrder($orderId);
                $yesAcceptCount=($order->articleCount-$toDeliverCount);
                Order::where('id',$orderId)
                ->update([
                    'toDeliverCount'=>$toDeliverCount,
                    'orderDelivered'=>'no',
                    'demagedArticle'=>null,
                    'demagedAcceptCount'=>null,
                    'noAcceptCount'=>null, 
                    'yesAcceptCount'=>$yesAcceptCount,
                    'reasonCancel'=>null,
                ]);
            }
        }
        return redirect()->back();
    
    }
    public function return()
    {
        $invoices=Order::returnOrders();
        $drivers=Driver::all();
        return view('order.return',compact(['invoices','drivers']));
    }
    public function goToResearch()
    {
        //Research Form
        return view('order.goToResearch');
    }
    public function research(Request $request)
    {
        //Get Results 'Invoices' of Research 
        return Order::research($request->research);
    }
    public function show($orderId) 
    {
        //Show Order, which would you like to update
        return view('order.show',['order'=>Order::getOrder($orderId)]);
    }
    public function unlock(Request $request)
    {
        if($request->action=='unlock')
        Order::where('id',$request->orderId)
        ->update([
            'demagedAcceptCount'=>0,
            'noAcceptCount'=>0
        ]);
        elseif($request->selectId=='noAcceptCount')
        {
            $noAcceptCount=Order::find($request->orderId)->noAcceptCount;
            Order::where('id',$request->orderId)
            ->update([
                'noAcceptCount'=>$request->action+$noAcceptCount
            ]);
        }
        elseif($request->selectId=='demagedAcceptCount')
        {
            $demagedAcceptCount=Order::find($request->orderId)->demagedAcceptCount;
            Order::where('id',$request->orderId)
            ->update([
                'demagedAcceptCount'=>$request->action+$demagedAcceptCount
            ]);
        }
        elseif($request->selectId=="cancelCount-unlock")
        {
            Order::where('id',$request->orderId)
            ->update([
                'cancelCount'=>null,
                'cancelDecision'=>null,
                'adminReaktion'=>null,
                'reasonCancel'=>null
            ]);
        }
       
    }
}
