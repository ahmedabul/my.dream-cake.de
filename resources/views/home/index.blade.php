@extends('app')
@section('content')
<div class="d-none d-md-block">
    <div class="homeCanvas">
        <canvas id="homeCanvas"></canvas>
    </div>
    <div class="canvas-wort ">
        <div class="row w-100">
            <div class="col-6">
                <p class="wort1"><span>D</span><span>R</span><span>E</span><span>A</span><span>M</span></p>
            </div>
            <div class="col-6">
                <p class="wort2"><span>C</span><span>A</span><span>K</span><span>E</span>
            </div>
            <div class="col-md-12 mt-md-5">
            <p class="bottom-line"> </p>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="row">
        <div class="slider col-12">
                <h2 class="text-center"> <a href="{{Route('category.index',['categoryId'=>1 ,'start'=>0])}}">Kinder</a></h2>
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($childrenArticles as $article)
                            @if ($loop->index==0)
                            <div class="carousel-item active">
                                <a href="{{Route('product.myProduct',[$article->id])}}"><img src="{{$article->mainPhoto}}" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption  d-none d-md-block">
                                <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>  
                                                          
                                </div>
                            </div>
                            @else
                            <div class="carousel-item">
                                <a href="{{Route('product.myProduct',[$article->id])}}"><img src="{{$article->mainPhoto}}" class="d-block w-100" alt="..."></a>
                                <div class="carousel-caption d-none d-md-block">
                                <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}} </a></h5>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
        </div>
    </div>
    <div class="row last-3articles">
        @foreach ($neuChildernArticels as $article)
        <div class="card col-md-4">
            <a href="{{Route('product.myProduct',[$article->id])}}"><img src='{{$article->mainPhoto}}'  alt="..."></a>
            <div class="card-body">
              <h5 class="card-title">{{$article->articleName}}</h5>
              <p class="card-text">{{$article->description}}</p>
              <div class="w-100"><a href="{{Route('product.myProduct',[$article->id])}}" class="btn btn-primary w-100">{{$article->articleName}}</a></div>
            </div>
          </div>
        @endforeach
    </div> 
</div>
<div class="container mt-5">
    <div class="row">
        <div class="slider col-12">
            <h2 class="text-center"><a href="{{Route('category.index',['categoryId'=>2 ,'start'=>0])}}">Geburtstag</a></h2>
            <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($birthsDateArticles as $article)
                        @if ($loop->index==0)
                        <div class="carousel-item active">
                            <a href="{{Route('product.myProduct',[$article->id])}}"><img src="{{$article->mainPhoto}}" class="d-block w-100" alt="..."></a>
                            <div class="carousel-caption d-none d-md-block">
                            <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            </div>
                        </div>
                        @else
                        <div class="carousel-item">
                            <a href="{{Route('product.myProduct',[$article->id])}}"><img src="{{$article->mainPhoto}}" class="d-block w-100" alt="..."></a>
                            <div class="carousel-caption d-none d-md-block">
                          <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            </div>
                        </div>
                        
                        @endif
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row last-3articles">
        @foreach ($neuBirthsDateArticels as $article)
        <div class="card col-md-4">
            <a href="{{Route('product.myProduct',[$article->id])}}"><img src='{{$article->mainPhoto}}' class="card-img-top" alt="..." ></a>
            <div class="card-body">
              <h5 class="card-title">{{$article->articleName}}</h5>
              <p class="card-text">{{$article->description}}</p>
              <div class="w-100"><a href="{{Route('product.myProduct',[$article->id])}}" class="btn btn-danger w-100">{{$article->articleName}}</a></div>
            </div>
          </div>
        @endforeach
    </div>
</div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="slider">
            <h2 class="text-center"><a href="{{Route('category.index',['categoryId'=>3 ,'start'=>0])}}">Hochzeit</a></h2>
            <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($weddingArticles as $article)
                        @if ($loop->index==0)
                        <div class="carousel-item active">
                            <a href="{{Route('product.myProduct',[$article->id])}}"><img src="{{$article->mainPhoto}}" class="d-block w-100" alt="..."></a>
                            <div class="carousel-caption d-none d-md-block">
                            <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            </div>
                        </div>
                        @else
                        <div class="carousel-item">
                            <a href="{{Route('product.myProduct',[$article->id])}}"><img src="{{$article->mainPhoto}}" class="d-block w-100" alt="..."></a>
                            <div class="carousel-caption d-none d-md-block">
                            <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions3" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row last-3articles">
        @foreach ($neuweddingArticles as $article)
        <div class="card col-md-4">
            <a href="{{Route('product.myProduct',[$article->id])}}"><img src='{{$article->mainPhoto}}' class="card-img-top" alt="..." ></a>
            <div class="card-body">
              <h5 class="card-title">{{$article->articleName}}</h5>
              <p class="card-text">{{$article->description}}</p>
              <div class="w-100"><a href="{{Route('product.myProduct',[$article->id])}}" class="btn btn-dark w-100">{{$article->articleName}}</a></div>
            </div>
          </div>
        @endforeach
    </div>
</div>

@endsection