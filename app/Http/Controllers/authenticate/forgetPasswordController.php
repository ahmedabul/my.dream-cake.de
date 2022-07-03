<?php

namespace App\Http\Controllers\authenticate;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class forgetPasswordController extends Controller
{
    public function form()
    {
        return view('authenticate.forgetPassword.form');
    }
    public function check(Request $request)
    {
        //Email dose NOT exist
        if(!Customer::checkEmail($request->email))
        {
            return redirect()->back()->with('sts1','Die eingegebene E-Mail-Adresse konnte nicht gefunden werden')->withInput();
        }
        //Password Validation
        if (forgetPasswordCheck($request->password)->fails())
        {
            return redirect()->back()->with('messages',forgetPasswordCheck($request->password)->errors()->messages())->withInput();
        }
        //Password Confirm
        if($request->password!=$request->confirm)
        {
            return redirect()->back()->with('sts1','Beide Passwörte sollen identsch sein')->withInput();
        }
        //Send an E-Mail 
        forgetPasswordEmailSend($request);
        return redirect()->back()->with('sts','Sie erhalten nun eine E-mail-Bestätigungsnachricht mit einem Link, um das neue Passwort zu ändern.');
        
    } 
    public function completeForgetPassword()
    {
        //Update Password
        if(resetPassword())
        {
            return redirect()->route('home.index');
        }
        
    }

}
