<?php

namespace App\Http\Controllers;

use App\Article;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        //Get all Articles
        $articles=Article::all();
        //Get the Count of Buttons in the Pagination 'in every Page 4 Articles'
        $articlesCount=ceil($articles->count()/12);
        //Get the first Four Articles
        $articles=$articles->skip(0)->take(12);
        //return View 'product.index
        return view('product.index',compact('articles'),['articlesCount'=>$articlesCount]);
    }
    public function show(Request $request)
    {
        //Get all Articles
        $articles=Article::all();
        //Get the Four Articles, they musst be showed from the page
        $articles=$articles->skip(($request->page-1)*12)->take(12);
        //return the Result of 'Articles' per Ajax to 'productController/index/paginationAjax.js'
        return  $articles;
    }
    public function myProduct($productId)
    { 
        //Get Comments
        $comments=Article::getComments($productId);
        //dd($comments);
        //Get the Article
        $product=Article::find($productId);
        //Get his all Photos
        $photos=Photo::where('article_id',$productId)->get();
        //The Customer accepts the Article after tow Days
        $acceptDate = Carbon::now()->addDays(3)->format('d.m.Y');
        return view('product.myProduct',compact('photos','comments'),['product'=>$product,'acceptDate'=>$acceptDate]);
    }
}
