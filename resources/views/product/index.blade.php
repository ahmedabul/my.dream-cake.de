@extends('app')
@section('content') 
    <div class="container products-index">
        <div class="row justify-content-center products-content-index">
            @foreach ($articles as $article)
            <div class="card col-md-3" >
               <a href="{{Route('product.myProduct',['productId'=>$article->id])}}"> <img class="card-img-top" src="{{$article->mainPhoto}}" alt="Card image cap"></a>
                <div class="card-body">
                    <div class="card-title row">
                         <h5 class="col-6"><a class="text-decoration-none text-dark" href="{{Route('product.myProduct',['productId'=>$article->id])}}">{{$article->articleName}}</a></h5>
                         <h5 class="col-6" style='text-align: right'>{{$article->price}}€</h5>
                    </div>
                  <p class="card-text">{{Str::limit($article->description,100)}}</p>
                  <div><a articleId={{$article->id}}  class="btn btn-danger addToCart">In den Warenkorb <i class="fa fa-shopping-cart" aria-hidden="true" style="color: white"></i></a></div>
                </div>
              </div>
            @endforeach 
        </div>
    </div>
    <div class="container products-pagination">
        <div class="row justify-content-center products-content-pagination">
        </div>
    </div>

    <nav class="d-flex justify-content-center mt-5  mb-5 product-pagination " aria-label="Page">
        <a class="btn btn-outline-danger left-btn"><<</a>
        <a class="btn btn-outline-danger right-btn">>></a>
        <div class="product-navigation">
            <div class="navigation">
                @for ($i = 0; $i < $articlesCount; $i++)
               <a class="btn btn-outline-danger button" href="{{Route('product.show',['page'=>$i+1])}}" page="{{$i+1}}">{{$i+1}}</a>
                @endfor
                
            </div>
        </div>
      </nav>

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