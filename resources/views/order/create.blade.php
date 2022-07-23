@php
    $totalPrice=0;
@endphp
@extends('app')
@section('content')
<div class="Orders-index container">
    <div class="card bg-dark text-white">
        <img src="/photos/sarajolie/BGthanksOrder.jpg" class="card-img" alt="..." style="height: 700px">
        <div class="card-img-overlay">
            <div class="invoice"> 
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Photo</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    @foreach ($orders as $order)
                        <tbody>
                            <tr>
                                <td >{{$order->articleName}}</td>
                                <td><img src="{{$order->mainPhoto}}"></td>
                                <td>{{$order->price}}€</td>
                                @php
                                    $totalPrice+=$order->price;
                                @endphp
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <table class="table table-dark table-striped mt-2">
                    <thead>
                        <tr>
                            <th >Lieferaddress</th>
                            <th>Datum der Bestellung</th>
                            <th>Datum der Zustellung</th>
                            <th >Gesamt Preis</th>
                            <th class="text-warning">Rechnung-Nr</th>
                        </tr>
                    </thead>
                    <body>
                        <td>
                            {{$order->daLastName}} {{$order->daFirstName}}<br>
                            {{$order->street}} {{$order->hausNr}}<br>
                            {{$order->city}} {{$order->plz}}
                        </td>
                        @php
                            $orderDate=new DateTime($order->orderDate);
                            $acceptDate=new DateTime($order->orderDate);
                            $acceptDate->add(new DateInterval('P3D'))
                        @endphp
                        <td>{{$orderDate->format('d-m-Y')}}</td>
                        <td>{{$acceptDate->format('d-m-Y')}}</td>
                        <td>{{$totalPrice}}€</td>
                        <td class="text-warning">{{$order->invoiceId}}</td>
                    </body>
                </table>
                <div class="thanksOrder-img">
                    <img src="/photos/sarajolie/thanksOrder.jpg" class="card-img" alt="..." style="width: 100%; height:200px">
                </div>
            </div>
        </div>
    </div>
    @php
    $totalPrice=null;
    @endphp
</div>    
@endsection