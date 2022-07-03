<?php

namespace App\Http\Controllers;

use App\Article;
use App\Delivery_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

class cartController extends Controller 
{
    public function goToCart()
    {
        //Get Multi-Arry 'articles' from Session
        $articles= session()->get('articles');

        //No Customer, DeliveryAddresses is NULL
        $deliveryAddresses=NULL;
        //Check, if Customer loged in
        if(Auth::guard('customer')->check())
        {
            //Get CustomerId
            $customerId=Auth::guard('customer')->user()->id;
            //Get all Deliveryaddresses of Customer, who loged in
            $deliveryAddresses=Delivery_address::getAdresses($customerId);
        }
        //Go to Cart
        return view('cart.goToCart',compact('articles','deliveryAddresses'));
    }
    public function addToCart(Request $request)
    {
        //Get the Article, which will be added to cart
        $article=Article::find($request->articleId);
        //return this Article to 'cart/cartOperation.js' per Ajax
        return $article;
    } 
    public function storeCart(Request $request)
    {
        //Store the Multi-Arry 'articles' in Session
        session()->put('articles',$request->articles);
        //Return successfuly Message
        return count(session()->get('articles'));
    }
    public function removeFromCart(Request $request)
    {
        //Store the new Multi-Array 'articles', without removed 'article'
        session()->put('articles',$request->articles);
        //Return successfuly Message 
       // return count(session()->get('articles'));
    }

}
 