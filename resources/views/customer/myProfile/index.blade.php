@extends('app')
@section('content')
<div class="myProfile-index">
    <div class="container p-5">
        <h2 class="text-center">Die Persönliche Daten</h2>
        <div class="customer-data mt-3">
            <form action="{{Route('myProfile.update')}}" method="POST" >
                @csrf
                <div class="row">
                    <input type="hidden" value="{{$user->id}}" name="customerId">
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="lastName" placeholder="Name" value="{{$user->lastName}}">
                        @if(!empty(Session::get('messages')['lastName']))
                        <small class="text-danger">{{Session::get('messages')['lastName'][0] }}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Vorname</label>
                        <input type="text" class="form-control" name="firstName" placeholder="Vorname" value="{{$user->firstName}}">
                        @if(!empty(Session::get('messages')['firstName']))
                        <small class="text-danger">{{Session::get('messages')['firstName'][0] }}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Stadt</label>
                        <input type="text" class="form-control" name="city" placeholder="Stadt" value="{{$deliveryAddress->city}}">
                        @if(!empty(Session::get('messages')['city']))
                        <small class="text-danger">{{Session::get('messages')['city'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">PLZ</label>
                        <input type="text" class="form-control" name="plz" placeholder="PLZ" value="{{$deliveryAddress->plz}}">
                        @if(!empty(Session::get('messages')['plz']))
                        <small class="text-danger">{{Session::get('messages')['plz'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Straße</label>
                        <input type="text" class="form-control" name="street" placeholder="Straße" value="{{$deliveryAddress->street}}">
                        @if(!empty(Session::get('messages')['street']))
                        <small class="text-danger">{{Session::get('messages')['street'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Haus-Nr</label>
                        <input type="text" class="form-control" name="hausNr" placeholder="Haus-Nr" value="{{$deliveryAddress->hausNr}}">
                        @if(!empty(Session::get('messages')['hausNr']))
                        <small class="text-danger">{{Session::get('messages')['hausNr'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-danger w-50">Aktualisieren</button>
                    </div>
                </div>
            </form>
            @if(!empty(Session::get('sts1')))
            <p class="text-center"><small class="text-success">{{Session::get('sts1')}}</small></p>
            @endif
        </div>
    </div>
</div>
@endsection