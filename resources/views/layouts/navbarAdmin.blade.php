<!--admin Navbar-->
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
      <li><a class="dropdown-item ml-2 disabled" href="{{Route('order.index',['date'=>'Today'])}}">Huete.. </a></li>
      <li><a class="dropdown-item ml-2  disabled" href="{{Route('order.index',['date'=>'Tomorrow'])}}">Morgen.. </a></li>
      <li><a class="dropdown-item ml-2  disabled" href="{{Route('order.index',['date'=>'AfterTomorrow'])}}">Übermorgen.. </a></li>
      <li><a class="dropdown-item ml-2  disabled" href="{{Route('order.index',['date'=>'After3Days'])}}">In drei Tagen.. </a></li>
      <li><a class="dropdown-item ml-2  " href="{{Route('order.goToResearch')}}">Suchen</a></li>
      <li><a class="dropdown-item ml-2  fw-bold" href="{{Route('order.return')}}">Rücklauf</a></li>
    <li><hr class="dropdown-divider"></li>
    <li class="text-danger">Fahrer</li>
      <li><a class="dropdown-item ml-2" href="{{Route('driver.create')}}">Fahrer Herstellen</a></li>
      <li><a class="dropdown-item ml-2" href="{{Route('driver.show')}}">Fahrer Suchen</a></li>
      <li><a class="dropdown-item ml-2 fw-bold " href="{{Route('order.ordersToDrivers')}}">Drivers &Orders</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="{{Route('login.logout')}}">Logout</a></li>
    </ul>
  </li>
</ul>


