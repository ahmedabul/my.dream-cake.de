<?php

namespace App\Http\Controllers;

use App\Article;
use App\Delivery_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class cartController extends Controller 
{ 
 
    public function add(Request $request)
    {
        if (!checkArticleImCart($request->articleId))
        {
        addToCart($request->articleId);
        return ['sts'=>'true','count'=>count($_SESSION['cartArticles'])];
        }
        return ['sts'=>'false','count'=>count($_SESSION['cartArticles'])];
    }
    public function remove($id)
    {
       removeFromCart($id); 
       return redirect()->route('cart.show');
    }
    public function show() 
    {
        //Get all Articles from Session
        $articles=goToCart();
        //Reset all Counts of Articles ['articleCount']=1
        resetCountsArticles();
        $deliveryAddresses=null;
        if(Auth::guard('customer')->check())
        {
            $customerId=Auth::guard('customer')->user()->id;
            $deliveryAddresses=Delivery_address::where('customer_id',$customerId)->get();
        }
        return view('cart.show',compact('articles','deliveryAddresses'));
    }
    public function change(Request $request)
    {
        articleCountChanged($request->articleId,$request->count);
        return array_values($_SESSION['cartArticles']);
    }



}
 