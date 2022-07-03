<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index');
    }
    public function create()
    {
        //Return Form to add new Category
        return view('category.create');
    }
    public function add(Request $request)
    {
        //Check addCategory-Form Validation
       if(categoryAddValidation($request)->fails())
       {
           return redirect()->back()->with('messages',categoryAddValidation($request)->errors()->messages())->withInput();
       }
       //Categoy exists
       if(categoryExists($request->name))
       {
        return redirect()->back()->with('sts','Diese Category ist schon vorhanden');
       }
       //Create new Category
       createNewCategory($request);
       //Redireck back with successfully Message
       return redirect()->back()->with('sts','Neue Category wurde erfolgreich hergestellt');
    }
    public function edit()
    {
        //get all Categories
        $categories=Category::all();
        //show all Categories
        return view('category.edit',compact('categories'));
    }
    public function update(Request $request)
    {
        //get Category which Admin choosed it
        $category=Category::where('id',$request->categoryId)->first();
        //show Category which Admin choosed it
        return view('category.update',['category'=>$category]);
    }
    public function save(Request $request)
    {
        //get PhotoPath of Category
        $photoPath=getCategoryPhotoPath($request->categoryId,$request->photo,$request->name);
        //Update the Category
        Category::where('id',$request->categoryId)
        ->update([
            'Categoryname'=>$request->name,
            'logo'=>$request->logo,
            'photo'=>$photoPath
        ]);
        //Rrdirect back with successfully Message
        return redirect()->back()->with('sts','Die Categore wurde erfolgreich aktualisieret');
    }
    public function index($categoryId,$start)
    {
        $category=Category::find($categoryId);
        $categoryArticles=Article::with('category')->where('category_id',$categoryId)->get();
        $articles=$categoryArticles->skip(($start)*12)->take(12);
        $articleCount=ceil(count($categoryArticles)/12);
        if($start==0)
        {
            //return view category.index
            return view('category.index',compact(['category','articles']),['articleCount'=>$articleCount]);
        }
        else{
            //retrn articles to ajax 
            return $articles;
        } 
    }
}
