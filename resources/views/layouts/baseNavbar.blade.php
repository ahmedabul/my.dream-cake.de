<!--base Navbar-->
@if(Auth::guard('driver')->check())    
    @include('layouts.navbarDriver')
@else
    @php
        $categories=getCategories();
    @endphp
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-danger" href="{{Route('home.index')}}"><span class="logo">DREAMCAKE</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{Route('home.index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{Route('product.index',['page'=>1])}}">Produkte</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Kategore
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                        <li><a class="dropdown-item" href="{{Route('category.index',['categoryId'=>$category->id,'start'=>0])}}">{{$category->categoryName}}</a></li>
                        @endforeach
                    
                    </ul>
                </li>
                </ul> 
                <ul class="navbar-nav  mb-2 mb-lg-0">
                <div class="text-danger "><p class="articlesLength">{{countArticlesImCart()}}</p> <a class="decoration-none goToCart" href="{{Route('cart.show')}}"><i class="fa fa-shopping-cart mt-1 btn" aria-hidden="true" style="color: white"></i></a> </div>
                </ul>
                @if(Auth::guard('customer')->check())
                    @include('layouts.navbarCustomer')
                @elseif(Auth::guard('admin')->check())
                    @include('layouts.navbarAdmin')
                @else
                    @include('layouts.navbarVisitor')
                @endif
            </div>
        </div>
    </nav>
@endif
