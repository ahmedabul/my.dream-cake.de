<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class homeController extends Controller
{
    public function index()
    {
        //einmalig nach Rollback Adding Admin Nadine
        /*Admin::create([
            'email'=>'sarahjolie@hotmail.com',
            'password'=>Hash::make(12345678)
        ]);*/
        $childrenArticles=Category::getArticles('Kinder');
        $birthsDateArticles=Category::getArticles('Geburtstag');
        $weddingArticles=Category::getArticles('hochzeit');
        return view('home.index',compact('childrenArticles','birthsDateArticles','weddingArticles'));
    }
}
