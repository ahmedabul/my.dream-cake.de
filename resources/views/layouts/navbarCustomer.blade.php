<!--Cutomer Navbar-->
<ul class="navbar-nav  mb-2 mb-lg-0" style="margin-right: 100px">
    <li class="nav-item dropdown">
        <span class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-user text-danger" aria-hidden="true"></i> 
        </span>              
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown"  style="margin-left:-20px;">
            <li><p class="text-center">{{Auth::guard('customer')->user()->firstName}}</p></li>
            <li><a class="dropdown-item" href="{{Route('myProfile.index')}}">Meine Profil</a></li>
            <li><a class="dropdown-item" href="{{Route('myProfile.deliveryAddress')}}">Neue Lieferadresse</a></li>
            <li><a class="dropdown-item" href="{{Route('myOrders.index')}}">Meine Bestellung</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{Route('login.logout')}}">Logout</a></li>
        </ul>
    </li>
  </ul>

