<?php

namespace App\Http\Controllers\authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class loginController extends Controller
{
    public function form()
    {
        return view('authenticate.login.form');
    }
    public function check(Request $request)
    {
      $user=loginCheck($request);
      if($user=='admin' or $user=='customer')
      { 
        return redirect()->route('home.index');
      }
      elseif($user=='driver')
      {
        return redirect()->route('driver.index');
      }
      return redirect()->back()->with('sts','E-mail oder Password ist leider falsch');
    }
    
    public function logout()
    {
        Auth::guard('customer')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('driver')->logout();
        logoutSession();
        return redirect()->route('home.index');
    }
}
