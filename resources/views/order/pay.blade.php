@php
$totalPrice=0;
@endphp
@extends('app') 
@section('content')
    <div class="pay">
        <div class="order">
            <div class="container">
                <table class="table  table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Article</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Anzahl</th>
                        <th scope="col">Prise</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                        <tr>
                            <td>{{$article['articleName']}}</td>
                            <td><img src="{{$article['mainPhoto']}}"></td>
                            <td>{{$article['articleCount']}}</td>
                            @php
                            $price= $article['articleCount']*$article['price'];
                            $totalPrice+=$price;
                            @endphp
                            <td>{{$price}}€</td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table> 
                <table class="table table-dark text-center">
                    <thead>
                    <tr>
                        <th class>Lieferaddress</th>
                        <th>Gesamt Prise</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td >
                                {{$deliveryAddress->lastName}} {{$deliveryAddress->firstName}}<br>
                                {{$deliveryAddress->street}} {{$deliveryAddress->hausNr}}<br>
                                {{$deliveryAddress->city}} {{$deliveryAddress->plz}} 
                            </td>
                            <td>{{$totalPrice}}€</td>
                        </tr>
                   </tbody>
                </table>
                <form class="text-center" method="POST" action="{{Route('paypal.index')}}">
                    @csrf
                  <input name="deliveryAddressId" type="hidden" value="{{$deliveryAddress->id}}">
                  <button type="submit" class="btn btn-info w-25 pay-btn"><img src={{asset("photos/sarajolie/paypal.png")}} style="height: 70px;width:200px"></button> 
                </form>
            </div>
        </div>
    </div>
@endsection