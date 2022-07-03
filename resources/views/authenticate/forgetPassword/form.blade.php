@extends('app') 
@section('content')
<form method="POST" action="{{Route('forgetPassword.check')}}">
    @csrf
    <div class="auth ">
        <div class="auth-forgetPassword">
            <div class="row">
                <h1>Forget Password</h1>
                <div class="col-12">
                    <div class="auth-textBox">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="email" placeholder="E-Mail" name="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" placeholder="new password" name="password" value="{{ old('password') }}">
                        <i class="fa fa-eye fa-fw mt-2 password" aria-hidden="true"></i>
                    </div>
                    @if(!empty(Session::get('messages')))
                    <small class="text-danger">{{Session::get('messages')['passwort'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" placeholder="confirm new password" name="confirm" value="{{ old('confirm') }}">
                        <i class="fa fa-eye fa-fw mt-2 password" aria-hidden="true"></i>
                    </div>
                    <p class="text-center text-white">Zum Ändern des Passwortes geben Sie das neue Passwort unter "new password" ein und bestätigen es unter "confirm new password"</p>
                   
                </div>
                <div class="text-center">
                    <input type="submit" class="btn-register mt-5 btn w-50" value="Passwort zurücksetzen">
                </div>
            </div>
            @if(!empty(Session::get('sts')))
            <div>
                <p class="text-success text-center">{{Session::get('sts')}} </p>
            </div> 
            @endif  
            @if(!empty(Session::get('sts1')))
            <div>
                <p class="text-danger text-center">{{Session::get('sts1')}} </p>
            </div> 
            @endif    
        </div>
    </div>
</form>
@endsection