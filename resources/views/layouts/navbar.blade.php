
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-danger" href="{{Route('home.index')}}"><span class="logo">SARAJOLIE</span></a>
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
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul> 
        <ul class="navbar-nav  mb-2 mb-lg-0">
          <div class="text-danger "><p class="articlesLength">{{countArticlesImCart()}}</p> <a class="decoration-none goToCart" href="{{Route('cart.goToCart')}}"><i class="fa fa-shopping-cart mt-1 btn" aria-hidden="true" style="color: white"></i></a> </div>
        </ul>
        @if(Auth::guard('customer')->check())
        <ul class="navbar-nav  mb-2 mb-lg-0" style="margin-right: 100px">
          <li class="nav-item dropdown">
              <span class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user text-danger" aria-hidden="true"></i> 
              </span>              
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="">{{Auth::guard('customer')->user()->firstName}} </a></li>
              <li><a class="dropdown-item" href="{{Route('myOrders.index')}}">Meine Bestellung</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{Route('login.logout')}}">Logout</a></li>
              </ul>
          </li>
        </ul>
        @elseif(Auth::guard('admin')->check())
        <ul class="navbar-nav  mb-2 mb-lg-0" style="margin-right: 100px">
          <li class="nav-item dropdown">
              <span class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               Admin
              </span>              
              <ul class="dropdown-menu admin" aria-labelledby="navbarDropdown">
                <li class="text-danger">Kategore</li>
                  <li><a class="dropdown-item ml-2" href="{{Route('category.create')}}">Kategore Herstellen</a></li>
                  <li><a class="dropdown-item ml-2" href="{{Route('category.edit')}}">Kategore Suchen</a></li>
                <li><hr class="dropdown-divider"></li>
                <li class="text-danger">Artikel</li>
                  <li><a class="dropdown-item ml-2" href="{{Route('article.create')}}">Artikel Herstellen</a></li>
                  <li><a class="dropdown-item ml-2" href="{{Route('article.index')}}">Artikel Suchen</a></li>
                <li><hr class="dropdown-divider"></li>
                <li class="text-danger">Bestellung</li>
                  <li><a class="dropdown-item ml-2" href="{{Route('order.index',['date'=>'Today'])}}">Huete sollen..</a></li>
                  <li><a class="dropdown-item ml-2" href="{{Route('order.index',['date'=>'Tomorrow'])}}">Morgen sollen..</a></li>
                  <li><a class="dropdown-item ml-2" href="{{Route('order.index',['date'=>'AfterTomorrow'])}}">Übermorgen sollen..</a></li>
                  <li><a class="dropdown-item ml-2" href="{{Route('order.index',['date'=>'After3Days'])}}">In drei Tagen sollen..</a></li>
                  <li><a class="dropdown-item ml-2" href="{{Route('order.index',['date'=>'Otherwise'])}}">Sonstiges..</a></li>
                <li><hr class="dropdown-divider"></li>
                <li class="text-danger">Fahrer</li>
                  <li><a class="dropdown-item ml-2" href="{{Route('driver.create')}}">Fahrer Herstellen</a></li>
                  <li><a class="dropdown-item ml-2" href="{{Route('driver.show')}}">Fahrer Suchen</a></li>
                <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{Route('login.logout')}}">Logout</a></li>
              </ul>
          </li>
        </ul>
        @else
        <ul class="navbar-nav  mb-2 mb-lg-0" style="margin-right: 50px">
            <li class="nav-item dropdown">
                <span class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login
                </span>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-right: 100px">
                <li><a class="dropdown-item" href="{{Route('login.form')}}">Login</a></li>
                <li><a class="dropdown-item" href="{{Route('register.form')}}">Register</a></li>
                </ul>
            </li>
        </ul>
        @endif 
      </div>
    </div>
  </nav>