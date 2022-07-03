@extends('app')
@section('content')
<form method="POST" action="{{Route('article.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="auth ">
        <div class="auth-articleCreate">
            <div class="row">
                <h1>Artikel Herstellen</h1>
                <div class="col-12">
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <input type="text" placeholder="Artikel Name" name="name" value="{{ old('name') }}" maxlength="15">
                    </div>
                    @if(!empty(Session::get('messages')['name']))
                    <small class="text-danger">{{Session::get('messages')['name'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <input type="text" placeholder="Preis" name="price" value="{{ old('price') }}" maxlength="3">
                    </div>
                    @if(!empty(Session::get('messages')['price']))
                    <small class="text-danger">{{Session::get('messages')['price'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <textarea type="text" placeholder="Beschreibung..." name="description" maxlength="250"> </textarea>
                    </div>
                    @if(!empty(Session::get('messages')['description']))
                    <small class="text-danger"> {{Session::get('messages')['description'][0]}} </small>
                    @endif
                </div>
                <div class="col-12 form-group">
                    <div class="auth-textBox">
                        <label for="exampleFormControlSelect1">Wählen Sie die Categore aus</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="categoryname">
                        <option> </option>
                        @foreach ($categories as $category)
                        <option>{{$category->categoryName}} </option>
                        @endforeach
                        </select>
                        @if(!empty(Session::get('messages')['categoryname']))
                        <small class="text-danger">{{Session::get('messages')['categoryname'][0]}}</small>
                        @endif
                    </div>
                </div>
                <div class ="col-12 mt-2">
                    <div class="form-group">
                        <div class="auth-textBox">
                            <label for="exampleFormControlFile1">Hauptfoto des Artikels</label>
                            <input type="file" class="form-control-file text-warning" id="exampleFormControlFile1" name="photo">
                        </div>
                    </div>
                    @if(!empty(Session::get('messages')['photo']))
                    <small class="text-danger">{{Session::get('messages')['photo'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12 mt-2">
                    <div class="form-group">
                        <div class="auth-textBox">
                            <label for="exampleFormControlFile1"> Fotos des Artikels </label>
                            <input type="file" class="form-control-file text-warning" id="exampleFormControlFile1"  name="photos[]"  multiple="multiple">
                        </div>
                    </div>
                    @if(!empty(Session::get('messages')['photos']))
                    <small class="text-danger">{{Session::get('messages')['photos'][0]}}</small>
                    @endif
                </div>
                <div class="text-center">
                    <input type="submit" class="btn-register mt-5 btn w-50" value="New Artikel">
                </div>
            </div>
            @if(!empty(Session::get('sts')))
            <div>
                <h2 class="text-danger text-center">{{Session::get('sts')}}</h2>
            </div>
            @endif    
        </div>
    </div>
</form>
@endsection