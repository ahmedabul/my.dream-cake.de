@extends('app') 
@section('content')
    <div class="myProduct container mt-2 mb-5">
        <div class="myProduct-header">
            <div class="myProduct-cover"></div>
            <img class="myProduct-mainPhoto" src="{{$product->mainPhoto}}" alt="">
            <div class="page-logo"><p class="text-center">DREAM CAKE</p></div>
            <div class="myProduct-name"><p class="text-center">{{$product->articleName}}</p></div>
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
                          <a articleId="{{$product->id}}" class="btn btn-danger addToThecart">In den Warenkorb</a>
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
    <div class="accordion mb-5" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <h3 class="text-info">Kundenkomentar</h3>
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                @foreach ($comments as $comment)
                <div class="accordion-item mt-1 bg-dark">
                    <h4 class="accordion-header bg-secondary" id="headingOne">
                        {{$comment->lastName}} {{$comment->firstName}}
                        @for ($i = 0; $i < $comment->stars; $i++)
                       <span class="text-warning"> <i class="fa fa-star" aria-hidden="true"></i></span>
                        @endfor
                        @for ($i = 0; $i < 5-$comment->stars; $i++)
                        <span>  <i class="fa fa-star" aria-hidden="true"></i></span>
                         @endfor
                    </h4>
                    <div id="{{$comment->id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-white">
                            {{$comment->customerComment}}
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
      </div>
    </div>
@endsection