@extends('app') 
@section('content')
    <div class="myProduct container mt-2 mb-5">
        <div class="myProduct-header">
            <div class="myProduct-cover"></div>
            <img class="myProduct-mainPhoto" src="{{$product->mainPhoto}}" alt="">
            <div class="page-logo"><p class="text-center">DREAM CAKE</p></div>
            <div class="myProduct-name d-none d-md-block"><p class="text-center">{{$product->articleName}}</p></div>
            <div class="line"></div>
        </div>
        <div class="myProduct-body mt-3">
            <div class="row">
                <div class="col-md-6">
                    <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            @foreach($photos as $photo)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->iteration }}" aria-label="Slide {{$loop->iteration+1}}"></button>
                            @endforeach
                    </div>
                        <div class="carousel-inner"> 
                            <div class="carousel-item active">
                                <img src="{{$product->mainPhoto}}" class="d-block w-100" alt="...">
                            </div>
                            @foreach($photos as $photo)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ $photo->path }}" alt="...">
                            </div>
                            @endforeach
                        </div> 
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" ></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header">
                         <h3> Beschreibung</h3>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">{{$product->articleName}}</h5>
                          <p class="card-text">{{$product->description}}</p>
                          <a  articleId={{$product->id}} class="btn btn-danger addToCart">In den Warenkorb</a>
                        </div>
                        <div class="card-footer text-muted">
                        Preise:{{$product->price}}€ <small>(inkl. MwSt.)</small>
                        </div>
                        <blockquote class="blockquote mb-0">
                            <p class="text-danger fw-bold">lieferzeit: in 3Tage</p>
                            <footer class="blockquote-footer text-danger">Annahme: <cite  title="Source Title">am {{ $acceptDate }}</cite></footer>
                          </blockquote>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <div class="comment">
        <div class="container">
            @foreach ($comments as $comment)
            <div class="head">
                <span><span style="font-size: 30px"><i class="fa fa-user-circle" aria-hidden="true"></i></span> <span style="font-size: 25px">{{$comment->lastName}} {{$comment->firstName}}</span><br>
                    @for ($i = 0; $i < $comment->stars; $i++)
                    <span class="text-warning"> <i class="fa fa-star" aria-hidden="true"></i></span>
                    @endfor
                    @for ($i = 0; $i < 5-$comment->stars; $i++)
                    <span>  <i class="fa fa-star" aria-hidden="true"></i></span>
                    @endfor
                </span>
            </div>
            <div class="body">
                {{$comment->customerComment}}
            </div>
            @endforeach
        </div>
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