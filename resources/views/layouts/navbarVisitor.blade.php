 <!--Visitor Navbar Login LogOut -->
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
