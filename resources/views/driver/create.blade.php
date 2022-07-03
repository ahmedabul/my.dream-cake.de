@extends('app')
@section('content')
<div class="driver">
    <form method="POST" action="{{Route('driver.save')}}">
        @csrf
        <h2>Neu Fahrer </h2>
        <div class="row">
            <div class="textBox col-md-5">
                <div class="row">
                <div class="col-md-12"><input type="text" name="driverFirstName" placeholder="Vorname" value="{{ old('driverFirstName') }}" ></div>
                @if(!empty(Session::get('messages')['driverFirstName'][0]))
                <small class="text-danger col-md-12">{{Session::get('messages')['driverFirstName'][0]}} </small>
                @endif
                </div>
            </div>
            <div class="textBox col-md-5">
                <div class="row">
                    <div class="col-md-12"><input type="text" name="driverLastName" placeholder="Nachname" value="{{ old('driverLastName') }}" ></div>
                    @if(!empty(Session::get('messages')['driverLastName'][0]))
                    <small class="text-danger col-md-12">{{Session::get('messages')['driverLastName'][0]}} </small>
                    @endif
                </div>
            </div>
            <div class="textBox col-md-5">
                <div class="row">
                    <div class="col-md-12"><input type="text" name="email" placeholder="E-Mail"  value="{{ old('email') }}"></div>
                    @if(!empty(Session::get('messages')['email'][0]))
                    <small class="text-danger col-md-12">{{Session::get('messages')['email'][0]}} </small>
                    @endif
                </div>
            </div>
            <div class="textBox col-md-5">
                <div class="row">
                    <div class="col-md-12"><input type="password" name="password" placeholder="Passwort"></div>
                    @if(!empty(Session::get('messages')['password'][0]))
                    <small class="text-danger col-md-12">{{Session::get('messages')['password'][0]}} </small>
                    @endif
                </div>
            </div>
            <div class="textBox col-md-5">
                <div class="row">
                    <div class="col-md-12"><input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}"></div>
                    @if(!empty(Session::get('messages')['phone'][0]))
                    <small class="text-danger col-md-12">{{Session::get('messages')['phone'][0]}} </small>
                    @endif
                </div>
            </div>
            <div class=" col-md-12 text-center">
                <button class="w-75 btn mt-3"type="submit">Speichern</button>
            </div>
        </div>
        @if(!empty(Session::get('sts')))
        <h3 class="text-primary text-center">{{Session::get('sts')}} </h3>
        @endif
    </form>
</div>
    
@endsection