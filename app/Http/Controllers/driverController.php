<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Mail\orderDeliveredEmail;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Mail;

class driverController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index','deliver','deliverConfirm','deliverCancel','cancelConfirm']);
    }
    public function create()
    {
        return view('driver.create');
    }
    public function save(Request $request)
    {
        //Validation
       if(driverValidation($request)->fails())
       {
        $messages=driverValidation($request)->errors()->messages();
        return redirect()->back()->with(['messages'=>$messages])->withInput();
       }
       //check Email
        if(checkEmail($request->email))
        {
            //Save new Driver
            Driver::create([
                'driverFirstName'=>$request->driverFirstName,
                'driverLastName'=>$request->driverLastName,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone'=>$request->phone
            ]);
            //successfuly created
            return redirect()->back()->with(['sts'=>'Ein neuer Fahrer wurde erfolgreich gespeichert']);
        }
        //Email exists
        return redirect()->back()->with(['sts'=>'Diese e-mail-Adresse ist schon vorhanden'])->withInput();
    }
    //Show all Drivers
    public function show()
    {
        $drivers=Driver::all();
        return view('driver.show',compact('drivers'));   
    }
    //Show a Driver
    public function edit($id)
    {
        $driver=Driver::find($id);
        return view('driver.edit',['driver'=>$driver]);
    }
    //Update the Driver
    public function update(Request $request) 
    {
        //get just new Data of the Driver 
        $driverData=getDriverData($request);
        //update 
        Driver::where('id',$request->driverId)
        ->update($driverData);
        return redirect()->back()->with(['sts'=>'Die Daten wurden erfolgreich aktualisiert'])->withInput();
    }
    public function index()
    {
        //Get all Orders, they should be delivered from a Driver
        $invoices=Driver::driverIndex();  
        
        return view('driver.index',compact('invoices'));
    }
    public function deliver($invoiceId)
    {
        //Get Orders, they the Driver will deliver now
        $orders=Driver::deliver($invoiceId); 
        return view('driver.deliver',compact('orders'));
    }
    public function deliverConfirm(Request $request)
    {
    
        //Validation, if the Driver will deliver the Article at a Neighbor
        if($request->articlePlace=='neighbor')
        {
            $validation=deliverConfirmValidation($request->nameOfNeighbor, $request->streetOfNeighbor, $request->hausNrOfNeighbor);
           if($validation->fails())
           {
               return redirect()->back()->with('messages',$validation->errors()->messages())->withInput();
           }
        }
        //Get Orders, they the Driver delivered to send an Email to Customer
        $orders=Driver::deliver($request->invoiceId);
        //Driver confirms the Deliver
         driverConfirmDeliver($request);

        //Send E-Mail to Customer with details of the Delivery
        Mail::to($request->email)->send(new orderDeliveredEmail($orders));
       return redirect()->route('driver.index');
    }
    public function deliverCancel($orderId)
    {
        $order=Order::find($orderId);
        $cancelCount=$order->articleCount-$order->yesAcceptCount-$order->demagedArticle;
        if($cancelCount==0)
        {
        return redirect()->back();
        }
        return view('driver.deliverCancel',['toDeliverCount'=>$cancelCount,'orderId'=>$orderId]);
    }
    public function cancelConfirm(Request $request)
    {
        //validation 
        if($request->toDeliverCount>1)
        {
            if(empty($request->demagedArticle) or empty($request->reasonCancel))
            {
                return redirect()->back()->with(['sts'=>'Antworten Sie bitte auf den beiden Fragen!!']);
            }
        }
        else
        {
            if(empty($request->reasonCancel))
            {
                return redirect()->back()->with(['sts'=>'Begründen Sie bitte, warum Sie die Bestellung Stönieren wöllen!!']);
            }
        }
        //Get Count of the demaged Article
        $order=Order::find($request->orderId);
        //calculate demagedArticle
        $demagedArticle=$order->demagedArticle+$request->demagedArticle;
        //Get the old reasonCancel
        $oldReasonCancel=$order->reasonCancel;
        //Update Order
        Order::where('id',$request->orderId)
        ->update([
            'cancelDecision'=>'fahrer',
            'reasonCancel'=>$oldReasonCancel.'--'.$request->demagedArticle.'.'.$request->reasonCancel.'--',
            'demagedArticle'=>$demagedArticle,
            'toDeliverCount'=>$demagedArticle,
        ]);

        return redirect()->route('driver.index');
    }

}
