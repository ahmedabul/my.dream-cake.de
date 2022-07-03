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
        //Get all Articles from Category 'Kinder'
        $childrenArticles=Category::getArticles('Kinder');
        //Get just last 3 Articles from Category 'Kinder'
        $neuChildernArticels=Category::getLast3_Articles('Kinder');
        //Get all Articles from Category 'Geburtstag'
        $birthsDateArticles=Category::getArticles('Geburtstag');
        //Get just last 3 Articles from Category 'Geburtstag'
        $neuBirthsDateArticels=Category::getLast3_Articles('Geburtstag');
        //Get all Articles from Category 'Hochzeit'
        $weddingArticles=Category::getArticles('hochzeit');
        //Get just last 3 Articles from Category 'Hochzeit'
        $neuweddingArticles=Category::getLast3_Articles('hochzeit');
        return view('home.index',compact('childrenArticles','neuChildernArticels','birthsDateArticles','neuBirthsDateArticels','weddingArticles','neuweddingArticles'));
    }
}
