<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $guard=['id'];
    protected $fillable = [
        'articleName', 'description', 'price', 'mainPhoto', 'category_id'
      ];
    
    public static function articleFotos($id)
    {
        return  Article::where('articles.id','=',$id)
        ->join('photos','photos.article_id','=','articles.id')
        ->select('path')
        ->get();
    } 
    public static function research($research)
    {
        return Article::where('articleName','like',$research.'%')
        ->orwhere('id','like',$research.'%')->get();
    } 
    public static function getComments($productId)
    {
        return DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->where('articles.id',$productId)
        ->where(function($query){
            $query->where('customerComment','!=',null);
        })
        ->get();
    } 
    public function order()
    {
        return $this->hasMany('App\Order');
    }
    public function photo()
    {
        return $this->hasMany('App\Photo');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
