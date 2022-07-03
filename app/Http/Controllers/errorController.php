<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class errorController extends Controller
{
    public function show($sts)
    {
        session()->forget('articles');
        return view('error.error',['sts'=>$sts]);
    }
}
