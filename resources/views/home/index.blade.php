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


<div class="container">
    <div class="row">
        <div class="slider col-12">
                <h2 class="text-center">Kinder</h2>
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($childrenArticles as $article)
                            @if ($loop->index==0)
                            <div class="carousel-item active">
                                <img src="{{$article->mainPhoto}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                                <p>{{$article->description}}</p>
                                </div>
                            </div>
                            @else
                            <div class="carousel-item">
                                <img src="{{$article->mainPhoto}}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                                <p>{{$article->description}}</p>
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
</div>
<div class="container">
    <div class="row">
        <div class="slider col-12">
            <h2 class="text-center">Geburtstag</h2>
            <div id="carouselExampleCaptions2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($birthsDateArticles as $article)
                        @if ($loop->index==0)
                        <div class="carousel-item active">
                            <img src="{{$article->mainPhoto}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                            <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            <p>{{$article->description}}</p>
                            </div>
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="{{$article->mainPhoto}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                          <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            <p>{{$article->description}}</p>
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
</div>
<div class="container">
    <div class="row">
        <div class="slider">
            <h2 class="text-center">Hochzeit</h2>
            <div id="carouselExampleCaptions3" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($weddingArticles as $article)
                        @if ($loop->index==0)
                        <div class="carousel-item active">
                            <img src="{{$article->mainPhoto}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                            <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            <p>{{$article->description}}</p>
                            </div>
                        </div>
                        @else
                        <div class="carousel-item">
                            <img src="{{$article->mainPhoto}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                            <h5><a href="{{Route('product.myProduct',[$article->id])}}"> {{$article->articleName}}</a></h5>
                            <p>{{$article->description}}</p>
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
</div>

@endsection