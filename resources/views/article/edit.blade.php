@extends('app')
@section('content')
<form method="POST" action="{{Route('article.update')}}" enctype="multipart/form-data">
    @csrf
    <div class="articleEdit">
        <div class="auth-articleIdit">
            <div class="col-12 text-center">
                <img src="{{$article->mainPhoto}}">
            </div>
            <div class="row">
                <h1>Artikel {{$article->articleName}} Aktualisieren</h1>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <label>Name des Artikels</label>
                        <input type="text" placeholder="Artikel Name" name="name" value="{{ $article->articleName}}" maxlength="15">
                        <input type="hidden" name="articleId" value="{{$article->id}}">
                    </div>
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <label>Preis</label>
                        <input type="text" placeholder="Preis" name="price" value="{{ $article->price }}" maxlength="3">
                    </div>
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <label>Bescreiben Sie das Artikel</label>
                        <textarea type="text" placeholder="Beschreibung..." name="description" maxlength="250">{{$article->description}} </textarea>
                    </div>
                </div>
                <div class="col-12 form-group">
                    <div class="auth-textBox">
                        <label for="exampleFormControlSelect1">Wählen Sie die Categore aus, wenn Sie die Categore des Artikels ändern wöllen</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="categoryname">
                        <option> </option>
                        @foreach ($categories as $category)
                        <option>{{$category->categoryName}} </option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class ="col-12 mt-2">
                    <div class="form-group">
                        <div class="auth-textBox">
                            <label for="exampleFormControlFile1">Hauptfoto des Artikels Wechseln</label>
                            <input type="file" class="form-control-file text-warning" id="exampleFormControlFile1" name="newMainPhoto">
                            <input type="hidden" name="oldMainPhoto" value="{{$article->mainPhoto}}">
                        </div>
                    </div>
                </div>
                <div class ="col-12 mt-2">
                    <div class="form-group">
                        <div class="auth-textBox">
                            <label for="exampleFormControlFile1">Noch Fotos Hinzufügen</label> 
                            <input type="file" class="form-control-file text-warning" id="exampleFormControlFile1"  name="photos[]"  multiple="multiple">
                        </div>
                    </div>
                </div>
                <div class="container articleFoto">
                    <div class="row justify-content-center">
                        @foreach ($articleFotos as $articleFoto)
                        <div class="col-md-4">
                            <div>
                                <img src="{{$articleFoto->path}}">
                            </div>
                            <div class="text-center">
                                <input type="checkbox" name='checkbox[]' value="{{$articleFoto->path}}" class="w-25"> <span class="text-danger">Löschen</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn-register mt-5 btn w-50" value="Aktualisieren">
                </div>
            </div>
            @if(!empty(Session::get('sts')))
            <div>
                <h2 class="text-danger text-center">{{Session::get('sts')}}</h2>
            </div>
            @endif    
        </div>
    </div>
@endsection