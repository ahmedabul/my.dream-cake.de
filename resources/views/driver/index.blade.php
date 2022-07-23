@extends('app')
@section('content')
@if(!empty(Session::get('messages')))
<div class="alert-messages">
    <div class="container">
        <h4 class="text-center text-danger mt-5 message ">Fehler bei der Datenübertragung, beachten Sie bitte folgende Regeln</h4>
        @foreach(Session::get('messages') as $message)
        <div class="alert alert-danger message" role="alert" >
            {{$message[0]}}
        </div>
        @endforeach
    </div>
</div>
@endif
<div class="driversOrders">
    <div class="container">
        @foreach ($invoices as $invoice)
            <form method="POST" action="{{Route('driver.deliver')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 orders-table">
                        <table class="table table-dark table-hover"> 
                            <thead>
                                <tr>
                                <th scope="col">Artikel</th>
                                <th scope="col">Foto</th> 
                                <th scope="col">Zustellen</th>
                                <th scope="col">Bestellung-Nr</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                @foreach ($invoice as $order)
                                <tr>
                                    <td>{{$order->articleName}}</td>
                                    <td><img src="{{$order->mainPhoto}}"></td> 
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$order->orderId}}" id="flexCheckDefault" name="delivered[]">
                                        </div>
                                    </td>
                                    <td>{{$order->orderId}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-dark table-hover text-center"> 
                            <thead>
                                <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Vorname</th>
                                <th scope="col">Adresse</th>
                                <th>Rechnung-Nr</th>
                                <th>Fahrer</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr>
                                    <td>{{$order->firstName}}</td>
                                    <td>{{$order->lastName}}</td>
                                    <td>{{$order->street}} {{$order->hausNr}}, {{$order->city}} {{$order->plz}}</td>
                                    <td>{{$order->invoiceId}}</td>
                                    <td>{{$order->driverFirstName}} {{$order->driverLastName}}, {{$order->driver_id}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-75">Zustellen</a>
                        </div>
                    </div>
                </div>
            </form>
        <div class="line"></div>
        @endforeach
    </div>
</div>
@endsection