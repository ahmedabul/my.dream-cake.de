@extends('app')
@section('content')
<div class="container d-flex justify-content-center categoryEdit" style="margin-top: 7%">
    <div class="row">
        @foreach ($categories as $category)
        <div class="card col-md-4 pb-2" >
            <img class="card-img-top" src="{{$category->photo}}" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">{{$category->categoryName}}</h5>
            <p class="card-text">{{$category->logo}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <a href="{{Route('category.update',['categoryId'=>$category->id])}}" class="btn btn-primary mt-2">Update</a>
            </ul>
        </div>
        @endforeach 
    </div>
</div>  
@endsection