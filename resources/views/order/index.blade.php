@php
    $totalPrice=0;
    $Nr=1;
@endphp
@extends('app')
@section('content')
    <div class="Orders-index container">
        <div class="card">
            <div class="card-body">   
                <h2 class="text-center">{{$indexTitle}} Sollen die folgenden Bestellungen erledigt werden..</h2>
            </div>
        </div>
            @foreach ($invoices as $invoice) 
                <div class="invoice row"> 
                    <div class="col-md-2"><h2>{{$Nr++}})</h2></div>
                    <div class="col-md-5">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Artikel</th>
                                <th>Foto</th>
                                <th>Anzahl</th>
                                <th>Preis</th>
                                <th>Zustand</th>
                                <th>Stönieren</th>
                            </tr> 
                        </thead>
                        @foreach ($invoice as $order)
                            <tbody>
                                <tr>
                                    <td >{{$order->articleName}}</td>
                                    <td><img src="{{$order->mainPhoto}}"></td>
                                    <td>{{$order->articleCount}}</td>
                                    <td>{{$order->articleCount*$order->price}}€</td>
                                    @php
                                        $totalPrice+=$order->articleCount*$order->price;
                                    @endphp
                                    @if(empty($order->cancelDecision))
                                        @if($order->orderDelivered=='no')
                                            <td class="text-warning">Am arbeiten</td>
                                            <td><a href="{{Route('order.cancelForm',['orderId'=>$order->orderId,'email'=>$order->email])}}" class="btn btn-danger w-100">Stönieren</a></td>
                                        @else
                                            <td class="text-success">zugestellt</td>
                                            <td class="text-center">--</td>
                                        @endif
                                    @else
                                        <td class="text-danger">von {{$order->cancelDecision}} stöniert</td>
                                        <td><a href="{{Route('order.cancelForm',['orderId'=>$order->orderId,'email'=>$order->email])}}" class="btn btn-success w-100">Details</a></td> 
                                    @endif
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    </div>
                    <div class="col-md-5">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Lieferaddress</th>
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
                    </div>
                </div>
                @php
                $totalPrice=0;
                @endphp
            @endforeach
    </div>
    <div class="delete-delivered-alert">
        <div class="row justify-content-center align-items-center h-100">
            <div class="order-alert col-6">
                <div class="alert-header">
                    <h2>Bestätigen Sie bitte Ihre Auswahl</h2>
                </div>
                <div class="alert-body">
                    <h4></h4>
                </div>
                <div class="alert-footer">
                    <button class=" w-25 btn btn-danger order-alert-yes">Ja</button> <button class="w-25 btn btn-success order-alert-no">Nein</button>
                </div>
                <div class="order-alert-spinner text-center mt-5 d-none">
                    <div class="spinner-grow text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="order-alert-sms text-success text-center mt-5">
                    <h6></h6>
                </div>
            </div>
        </div>
    </div>
@endsection