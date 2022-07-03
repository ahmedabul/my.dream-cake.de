@extends('app')
@section('content')
<form method="POST" action="{{Route('login.check')}}">
    @csrf
    <div class="auth ">
        <div class="auth-login">
            <div class="row">
                <h1>Login</h1>
                <div class="col-12">
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="text" placeholder="E-Mail" name="email" value="{{ old('email') }}" >
                    </div>
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" placeholder="Passwort" name="password" value="{{ old('password') }}">
                        <i class="fa fa-eye fa-fw mt-2 password" aria-hidden="true"></i>
                    </div>
                    <div  class ="col-12 text-center"> 
                        <a class="btn text-primary" href="{{Route('forgetPassword.form')}}">Passwort vergessen</a>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn-register mt-5 btn w-50" value="Login">
                </div>
            </div>
            @if(!empty(Session::get('sts')))
            <div>
                <h2 class="text-danger text-center">{{Session::get('sts')}} </h2>
            </div>
            @endif    
        </div>
    </div>
</form>
@endsection