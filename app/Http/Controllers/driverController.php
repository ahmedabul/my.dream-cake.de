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
        $this->middleware('admin')->except(['index','deliver','deliverConfirm','cancelConfirm']);
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
    public function deliver(Request $request)
    {
        //Driver had not chosed any Order
        if(empty($request->delivered))
        {
            return redirect()->back();
        }
        //Get Orders, they the Driver will deliver now
        $orders=[];
        foreach($request->delivered as $index =>$orderId)
        {
        array_push($orders,Driver::deliver($orderId));
        }
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
               return redirect()->route('driver.index')->with('messages',$validation->errors()->messages());
           }
        }
        //Get Orders, they the Driver delivered to send an Email to Customer
        $orders=[];
        foreach($request->orderIds as $index =>$orderId)
        {
            //Driver confirms the Deliver
            driverConfirmDeliver($request->nameOfNeighbor, $request->streetOfNeighbor, $request->hausNrOfNeighbor, $orderId, $request->articlePlace);
            array_push($orders,Driver::deliver($orderId));
        }

        //Send E-Mail to Customer with details of the Delivery
        Mail::to($request->email)->send(new orderDeliveredEmail($orders));
       return redirect()->route('driver.index');
    }
  

}
