<?php

namespace App\Http\Controllers\customer;

use App\Customer;
use App\Delivery_address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class myProfileController extends Controller
{
    public function index ()
    {
        //Daten of customer
        $user=Auth::guard('customer')->user();
        //Address of Customer
        $deliveryAddress=Delivery_address::where('customer_id',$user->id)->get()->first();
        return view('customer.myProfile.index',compact('user','deliveryAddress'));
    }
    public function update(Request $request)
    {
        if(validationUpdate($request)->fails())
        {  
             return redirect()->back()->with('messages', validationUpdate($request)->errors()->messages())->withInput(); 
        }
       Customer::where('id',$request->customerId)
       ->update([
           'lastName'=>$request->lastName,
           'firstName'=>$request->firstName
       ]);
       $deliveryAddressId=Delivery_address::where('customer_id',$request->customerId)
       ->get()
       ->first()->id;
       Delivery_address::where('id',$deliveryAddressId)
       ->update([
        'city'=>$request->city,
        'plz'=>$request->plz,
        'street'=>$request->street,
        'hausNr'=>$request->hausNr
       ]);

       return redirect()->back()->with('sts1','Die Daten wurden erfolgreich aktualisiert'); 

    }
    public function deliveryAddress()
    {
        //Daten of customer
        $user=Auth::guard('customer')->user();
        //Address of Customer
        $deliveryAddress=Delivery_address::where('customer_id',$user->id)->get()->first();
        return view('customer.myProfile.deliveryAddress',compact('user','deliveryAddress'));
    }
    public function addDeliveryAddress(Request $request)
    {
        if(validationUpdate($request)->fails())
        {  
            return redirect()->back()->with('messages', validationUpdate($request)->errors()->messages())->withInput(); 
        }
        $data=getUpdateData($request);
        $data['customer_id']=$request->customerId;
        Delivery_address::create($data);
        return redirect()->back()->with('sts2','Eine neue Lieferadresse wurde gespeichert'); 

    }
}
