@extends('app')         
@section('content')
    <div class="container" style="margin-top: 100px; padding:50px">
        <div class="row">
            @foreach ($drivers as $driver)
            <div class="card col-md-4 mt-1">
                <h5 class="card-header">{{$driver->driverLastName}} {{$driver->driverFirstName}}</h5>
                <div class="card-body">
                  <h5 class="card-title">Id:{{$driver->id}}</h5>
                  <p class="card-text">{{$driver->email}}</p>
                  <p class="card-text">{{$driver->phon}}</p>
                  <a href="{{Route('driver.edit',['id'=>$driver->id])}}" class="btn btn-primary">Aktualisieren</a>
                </div>
              </div>
            @endforeach
        </div>
    </div>
@endsection