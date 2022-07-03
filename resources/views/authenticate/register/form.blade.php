@extends('app')
@section('content')
<form method="POST" action="{{Route('register.check')}}">
    @csrf
    <div class="auth ">
        <div class="auth-register">
            <div class="row">
                <h1>Register</h1>
                <div class="col-12">
                </div>
                <div class ="col-6">
                    <div class="auth-textBox">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" placeholder="Name" name="lastName" value="{{ old('lastName') }}" maxlength="15">
                    </div>
                    @if(!empty(Session::get('messages')['lastName'][0]))
                    <small class="text-danger">{{Session::get('messages')['lastName'][0]}} </small>
                    @endif
                </div>
                <div class ="col-6">
                    <div class="auth-textBox">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <input type="text" placeholder="Vorname" name="firstName" value="{{ old('firstName') }}" maxlength="15">
                    </div>
                    @if(!empty(Session::get('messages')['firstName'][0]))
                    <small class="text-danger">{{Session::get('messages')['firstName'][0]}} </small>
                    @endif
                </div>
                <div class="col-6">
                    <div class="auth-textBox">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="text" placeholder="Email" name="email" value="{{ old('email') }}">
                    </div>
                    @if(!empty(Session::get('messages')['email'][0])) 
                    <small class="text-danger">{{Session::get('messages')['email'][0]}} </small>
                    @endif
                </div>
                <div class="col-6">
                    <div class="auth-textBox">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" placeholder="Passwort" name="password" value="">
                        <i class="fa fa-eye fa-fw mt-2 password" aria-hidden="true"></i>
                    </div>
                    @if(!empty(Session::get('messages')['password'][0]))
                    <small class="text-danger">{{Session::get('messages')['password'][0]}} </small>
                    @endif
                </div>
                <div class="col-6">
                    <div class="auth-textBox">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                        <input type="text" placeholder="Stadt" name="city" value="{{ old('city') }}" maxlength="15">
                    </div>
                    @if(!empty(Session::get('messages')['city'][0]))
                    <small class="text-danger">{{Session::get('messages')['city'][0]}} </small>
                    @endif
                </div>
                <div class="col-6">
                    <div class="auth-textBox">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <input  maxlength="6" placeholder="PLZ" name="plz" value="{{ old('plz') }}">
                    </div>
                    @if(!empty(Session::get('messages')['plz'][0]))
                    <small class="text-danger">{{Session::get('messages')['plz'][0]}} </small>
                    @endif
                </div>
                <div class="col-6">
                    <div class="auth-textBox">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <input type="text" placeholder="HausNr" name="hausNr" value="{{ old('hausNr') }}" maxlength="3">
                    </div>
                    @if(!empty(Session::get('messages')['hausNr'][0]))
                    <small class="text-danger">{{Session::get('messages')['hausNr'][0]}} </small>
                    @endif
                </div>
                <div class="col-6">
                    <div class="auth-textBox">
                        <i class="fa fa-road" aria-hidden="true"></i>
                        <input type="text" placeholder="Straße" name="street" value="{{ old('street') }}" maxlength="15">
                    </div>
                    @if(!empty(Session::get('messages')['street'][0]))
                    <small class="text-danger">{{Session::get('messages')['street'][0]}} </small>
                    @endif
                </div>
                <div class="text-center">
                    <input type="submit" class="btn-register mt-5 btn w-50" value="Registieren">
                </div>
            </div>
            @if(!empty(Session::get('sts')))
            <div>
                <p class="text-success text-center">{{Session::get('sts')}} </p>
            </div>
            @endif
        </div>
    </div>
</form>          
@endsection