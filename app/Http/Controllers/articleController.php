<?php

namespace App\Http\Controllers; 

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class articleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('article.index');
    }
    public function research(Request $request) 
    {
        $articles=Article::research($request->research);
        //return Results 'articles' to js/articleController/index per Ajaxs
        return(['articles'=>$articles]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation Checking
        if(articleStoreValidation($request)->fails())
        {
           return redirect()->back()->with('messages',articleStoreValidation($request)->errors()->messages())->withInput();
        }
        //store the new Article 
        storeArticle($request);
        //get the ArticleId
        $articleId=getLastId(Article::class);
        //store all Photos of the new Article
        storeArticlePhotos($request->photos, $articleId);
        //Redirect back with successfuly Message
        return redirect()->back()->with('sts','Ein neues Artikel wurde erfolgreich hergestellt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $article=Article::where('id',$id)->first();
        $articleFotos=Article::articleFotos($id);
        $categories=Category::all();
        return view('article.edit',['article'=>$article,'categories'=>$categories, 'articleFotos'=>$articleFotos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Get just Attributes, they are DONT empty 'filter'
         $articleAttributes=articleAtributesFilter($request);
        //Article Update
        Article::where('id',$request->articleId)
        ->update($articleAttributes);
        //Photos, they musst be deleted
        articlePhotosDelete($request->checkbox, $request->articleId);
        return redirect()->back()->with('sts','Das Artikel wurde erfolgreich aktualisiert');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
