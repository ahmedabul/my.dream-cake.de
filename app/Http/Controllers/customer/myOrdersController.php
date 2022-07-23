<?php

namespace App\Http\Controllers\customer;

use App\Article;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class myOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('customer');  
    }
    public function index()
    {
        
        //Get all Orders from the Customer, which loged in. Invoices::getInvoices($customerId)
        $invoices=Invoice::getInvoices(Auth::guard('customer')->user()->id);
        return view('customer.myOrders.index',compact('invoices'));
    } 
    public function acceptOrder($answer, $orderId)
    {
        if($answer=='yes')
        {
            Order::where('id',$orderId)
            ->update([
                'accept'=>'1',
            ]);
        }
        elseif($answer=='no')
        {
            Order::where('id',$orderId)
            ->update([
                'noAccept'=>'1',
            ]);
        }
        elseif($answer=='damaged')
        {
            Order::where('id',$orderId)
            ->update([
                'damaged'=>'1',
            ]);
        }
        else{

        }
        //Get the Article, which ordered the Customer
        $article=Customer::getMyOrder($orderId);
        //Form to discomfort or to evaluate
        return view('customer.myOrders.acceptOrder',['answer'=>$answer, 'orderId'=>$orderId, 'article'=>$article]);
    }
    public function comment(Request $request)
    {
     
       if(empty($request->stars) || empty($request->customerComment))
       {
        return redirect()->back()->with(['sts'=>'Bitte füllen Sie alle Felder aus bevor Sie das Formular absenden.'])->withInput();
       }
       Order::where('id',$request->orderId)
       ->update([
            'stars'=>$request->stars,
            'customerComment'=>$request->customerComment
       ]);
       return redirect()->route('myOrders.index');
    }

}
