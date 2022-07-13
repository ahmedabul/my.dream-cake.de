@extends('app') 
@section('content')
    <div class="category">
        <div class="cover">
            <h2 class="text-center"><span>{{$category->logo}}</span></h2>
            <h3><span> DREAM CAKE </span></h3>
        </div>
        <div class="header">
            <img src="{{$category->photo}}">
        </div>
        <div class="content">
            <div class="container">
                <div class="title">
                    <h2 class="text-center"><span>{{$category->categoryName}} Produkte</span></h2>
                </div>
                <div class="row category-articles">
                    @foreach ($articles as $article)
                    <div class="card col-md-3" >
                       <a href="{{Route('product.myProduct',['productId'=>$article->id])}}"> <img class="card-img-top" src="{{$article->mainPhoto}}" alt="Card image cap"></a>
                        <div class="card-body">
                            <div class="card-title row">
                                 <h5 class="col-6"><a class="text-decoration-none text-dark" href="{{Route('product.myProduct',['productId'=>$article->id])}}">{{$article->articleName}}</a></h5>
                                 <h5 class="col-6" style='text-align: right'>{{$article->price}}€</h5>
                            </div>
                          <p class="card-text">{{Str::limit($article->description,100)}}</p>
                          <div><a articleId={{$article->id}} class="btn btn-danger addToCart">In den Warenkorb <i class="fa fa-shopping-cart" aria-hidden="true" style="color: white"></i></a></div>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
        <nav class="d-flex justify-content-center mt-5  mb-5 category-pagination" aria-label="Page">
            <a class="btn btn-outline-danger left-btn"><<</a>
            <a class="btn btn-outline-danger right-btn">>></a>
            <div class="category-navigation">
                <div class="navigation">
                    @for ($i = 0; $i < $articleCount; $i++)
                    <a href="{{Route('category.index',['categoryId'=>$category->id,'start'=>$i])}}" class="btn btn-outline-danger button" page="{{$i}}" categoryId="{{$category->id}}">{{$i+1}}</a>
                    @endfor  
                </div>
            </div>
        </nav> 
    </div>
    <div class="cart-alert d-none">
        <div class="message-md w-50 d-none d-md-block">
            <h2 class="text-center">Das Artikel ist schon im Warenkorb!!!</h2>
            <div class="row buttons">
                <div class="col-md-6">
                    <a class="btn btn-danger w-100 cart-alert-remove" href="{{Route('cart.show')}}">Warenkorb ansehen<i class="fa fa-shopping-cart btn" aria-hidden="true" style="color: white"></i></a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-danger w-100 cart-alert-remove" >Zurück<i class="fas fa-window-close btn" aria-hidden="true" style="color: white"></i></a>
                </div>
            </div>
        </div>
        <div class="message-sm d-md-none">
            <h2 class="text-center">Das Artikel ist schon im Warenkorb!!!</h2>
            <div class="row buttons">
                <div class="col-12">
                    <a class="btn btn-danger w-100 cart-alert-remove" href="{{Route('cart.show')}}">Warenkorb ansehen<i class="fa fa-shopping-cart btn" aria-hidden="true" style="color: white"></i></a>
                </div>
                <div class="col-12">
                    <a class="btn btn-danger w-100 cart-alert-remove mt-3" >Zurück<i class="fas fa-window-close btn" aria-hidden="true" style="color: white"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection