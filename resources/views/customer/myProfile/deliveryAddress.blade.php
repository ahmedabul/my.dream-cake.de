@extends('app')
@section('content')
<div class="myProfile-index">
    <div class="container p-5">
        <h2 class="text-center">Neu Lieferadresse</h2>
        <div class="add-deliveryAddress">
            <form action="{{Route('myProfile.addDeliveryAddress')}}" method="POST" >
                @csrf
                <div class="row">
                    <input type="hidden" value="{{$user->id}}" name="customerId">
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="lastName" placeholder="Name" value="{{old('lastName')}}">
                        @if(!empty(Session::get('messages')['lastName']))
                        <small class="text-danger">{{Session::get('messages')['lastName'][0] }}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Vorname</label>
                        <input type="text" class="form-control" name="firstName" placeholder="Vorname" value="{{old('firstName')}}">
                        @if(!empty(Session::get('messages')['firstName']))
                        <small class="text-danger">{{Session::get('messages')['firstName'][0] }}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Stadt</label>
                        <input type="text" class="form-control" name="city" placeholder="Stadt" value="{{old('city')}}">
                        @if(!empty(Session::get('messages')['city']))
                        <small class="text-danger">{{Session::get('messages')['city'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">PLZ</label>
                        <input type="text" class="form-control" name="plz" placeholder="PLZ" value="{{old('plz')}}">
                        @if(!empty(Session::get('messages')['plz']))
                        <small class="text-danger">{{Session::get('messages')['plz'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Straße</label>
                        <input type="text" class="form-control" name="street" placeholder="Straße" value="{{old('street')}}">
                        @if(!empty(Session::get('messages')['street']))
                        <small class="text-danger">{{Session::get('messages')['street'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Haus-Nr</label>
                        <input type="text" class="form-control" name="hausNr" placeholder="Haus-Nr" value="{{old('hausNr')}}">
                        @if(!empty(Session::get('messages')['hausNr']))
                        <small class="text-danger">{{Session::get('messages')['hausNr'][0]}}</small>
                        @endif
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-danger w-50">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection