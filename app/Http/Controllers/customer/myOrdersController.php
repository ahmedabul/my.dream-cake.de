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
        //Get the Article, which ordered the Customer
        $article=Customer::getMyOrder($orderId);
        //Get the Count of articles, they the Customer accepted
        $countAcceptedArticles=$article->articleCount-$article->yesAcceptCount-$article->noAcceptCount-$article->demagedAcceptCount-$article->demagedArticle;
        //Form to discomfort or to evaluate
        return view('customer.myOrders.acceptOrder',['answer'=>$answer, 'orderId'=>$orderId, 'article'=>$article, 'countAcceptedArticles'=>$countAcceptedArticles]);
    }
    public function comment(Request $request)
    {
        //Validation
        if(empty($request->article))
        {
            return redirect()->back()->with('sts','Fühllen Sie bitte die Umfrage aus, damit wir ihnen helfen können');
        }
            if($request->comment=='demaged')
            {
                $count=Order::getOrder($request->orderId)->demagedAcceptCount;
                $count=$count+$request->article;
            
                Order::where('id',$request->orderId)
                ->update([
                    'customerAccept'=>'no',
                    'demagedAcceptCount'=>$count
                ]);
            }
            elseif($request->comment=='noAccept')
            {
                $count=Order::getOrder($request->orderId)->noAcceptCount;
                $count=$count+$request->article;
            
                Order::where('id',$request->orderId)
                ->update([
                    'customerAccept'=>'no',
                    'noAcceptCount'=>$count
                ]);
               
            }
            elseif($request->comment=='yesAccept')
            {
                $count=Order::getOrder($request->orderId)->yesAcceptCount;
                $count=$count+$request->article;
                Order::where('id',$request->orderId)
                ->update([
                    'yesAcceptCount'=> $count,
                    'customerComment'=>$request->customerComment,
                    'stars'=>$request->stars,
                    'customerComment'=>$request->customerComment
                ]);
            }
        
        return redirect()->route('myOrders.details',['orderId'=>$request->orderId]);
    }
    public function details($orderId)
    {
        $order=Order::getOrder($orderId);
        return view('customer.myOrders.details',['order'=>$order]);
    }
}
