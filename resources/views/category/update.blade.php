@extends('app')
@section('content')
<form method="POST" action="{{Route('category.save')}}" enctype="multipart/form-data">
    @csrf
    <div class="auth ">
        <div class="auth-categoryCreate">
            <div class="row">
                <input class="d-none" name="categoryId" value="{{$category->id}}">
                <div class="col-12 text-center mt-3">
                <img src="{{$category->photo}}">
                </div>
                <h1>Kategore {{$category->categoryName}} Aktualisieren</h1>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <input type="text" placeholder="Name der Kategore" name="name" value="{{ $category->categoryName}}" maxlength="150">
                    </div>
                    @if(!empty(Session::get('messages')['name']))
                    <small class="text-danger">{{Session::get('messages')['name'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <input type="text" placeholder="Logo der Kategore" name="logo" value="{{ $category->logo }}" maxlength="150">
                    </div>
                    @if(!empty(Session::get('messages')['logo']))
                    <small class="text-danger">{{Session::get('messages')['logo'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12">
                    <div class="form-group mt-2">
                            <label>Categoryfoto</label>
                            <input type="file" name="photo" class="foto text-warning" id="exampleFormControlFile1" value="{{ $category->photo }}">
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn-register mt-5 btn w-50" value="Aktualisieren" >
                </div>
            </div>
            @if(!empty(Session::get('sts')))
            <div>
                <h2 class="text-danger text-center">{{Session::get('sts')}} </h2>
            </div>
            @endif    
        </div>
    </div>
</form>
@endsection