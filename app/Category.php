<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $guard=['id'];
    protected $fillable = [
        'categoryName', 'logo', 'photo'
      ];
     public function article()
    {
        return $this->hasMany('App\Article');
    }
    public static function getArticles($categoryName)
    {
        return DB::table('categories')
        ->join('articles','categories.id','=','articles.category_id')
        ->where('categories.categoryName',$categoryName)
        ->get();
    }
}
