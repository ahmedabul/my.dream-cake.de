@extends('app')
@section('content')
<div class="driver-show">
    <form method="POST" action="{{Route('driver.update')}}">
        @csrf
        <input type="hidden" name="driverId" value="{{ $driver->id }}" >
        <h2>Fahrer Aktualisieren </h2>
            <div class="textBox">
                <input type="text" name="driverFirstName" placeholder="Vorname" value="{{ $driver->driverFirstName }}" >
            </div>
            <div class="textBox">
                <input type="text" name="driverLastName" placeholder="Nachname" value="{{ $driver->driverLastName }}" >
            </div>
            <div class="textBox">
                <input type="password" name="password" placeholder="Passwort">
            </div>
            <div class="textBox">
                <input type="text" name="phone" placeholder="Phone" value="{{ $driver->phone}}">
            </div>
            <div class=" col-md-12 text-center">
                <button class="w-75 btn mt-3"type="submit">Aktualisieren</button>
            </div>
            @if(!empty(Session::get('sts')))
            <h5 class="text-primary text-center">{{Session::get('sts')}} </h5>
            @endif
        </div>
    </form>
</div>
@endsection