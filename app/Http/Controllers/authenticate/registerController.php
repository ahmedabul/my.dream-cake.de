<?php

namespace App\Http\Controllers\authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class registerController extends Controller
{
    public function form()
    {
        return view('authenticate.register.form');
    }

    public function check(Request $request)
    {
        //With Register-Validation-Error
       if(validationRegister($request)->fails())
       {  
        return redirect()->back()->with('messages', validationRegister($request)->errors()->messages())->withInput(); 
       }
       //check if E-mail exists
       if(emailExistiert($request->email)) 
       {
        return redirect()->back()->with('sts','Diese e-mail-Adresse ist schon vorhanden')->withInput(); 
       }
       //Without Register-Validation-Error AND E-mail dose'nt exist => 'send the Register-Email'
       sendRegisterEmail($request);
       return redirect()->back()->with('sts','Sie erhalten nun eine E-mail-Bestätigungsnachricht mit einem Link, um Ihre E-mail-Adresse zu verifizieren.')->withInput(); 
    }
    public function completeRegister(Request $request)
    {
        //Customer Veriable exists in Session
        if(!empty($request->session()->get('customer')))
        {
            //Create new Customer
            createCustomer($request->session()->get('customer'));
            //Authenticate
            Auth::guard('customer')->attempt(['email'=>$request->session()->get('customer')['email'],'password'=>$request->session()->get('customer')['password']]);
            //Delete Customer Veriable from Session
            $request->session()->forget('customer');
            //Return to the Index of Sarajolie
            return redirect()->route('home.index');
        }
        //Customer Veriable dose NOT exist in Session
        return view('error.error',['sts'=>'Ein Fehler ist aufgetreten']);
    }

}
