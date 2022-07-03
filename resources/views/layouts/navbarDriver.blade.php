@php
    $driver=Auth::guard('driver')->user();
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-danger">SARAJOLIE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ml-0 ml-md-5">
                <li class="nav-item ml-0">
                   
                </li>
            </ul>
            <div class="d-flex justify-content-end">
                <div class="nav-item">
                    <small class="nav-link text-white mt-1">{{$driver->driverFirstName}} {{$driver->driverLastName}}</small>
                </div>
                    <div class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="{{Route('login.logout')}}">Logout</a>
                    </div>
            </div>
        </div>
    </div>
</nav>