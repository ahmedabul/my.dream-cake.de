@extends('app')
@section('content')
    <div class="order-return" style="margin-top: 100px">
        <div class="container">
            <div class="header">
                <h2 class="text-center text-danger">Alle Bestellungen</h2>
            </div>
            <div class="body">
                @foreach ($invoices as $invoice => $orders)
                    @php
                        $orderIds=array(); 
                    @endphp
                    <form method="POST" action="{{Route('order.orderDriverSave')}}"> 
                        @csrf 
                        <div class="tables">
                            <div class="table-1">
                                <table class="table table-dark text-center">
                                    <thead>
                                    <tr>
                                        <th>Abgeschlossen</th>
                                        <th>Bestellung-Nr</th>
                                        <th scope="col">Artikel</th> 
                                        <th scope="col">Foto</th>
                                        <th>Versuch-Nr</th>
                                        <th>Fahrer</th>
                                    </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @if($order->ready==0)
                                                <tr>
                                                <td ><a href="{{Route('order.finish',['orderId'=>$order->orderId,'key'=>'yes'])}}" class="btn btn-primary">Ja</a></td>
                                                @else
                                                <tr class="table-light">
                                                <td><a href="{{Route('order.finish',['orderId'=>$order->orderId,'key'=>'no'])}}" class="btn btn-primary">Nein</a></td>
                                            @endif
                                                <td>{{$order->orderId}}</td>
                                                <td>{{$order->articleName}}</td>
                                                <td><img src="{{$order->mainPhoto}}" style="height: 50px;width:50px"></td>
                                                <td>{{$order->tryCount}}</td>
                                                <td>{{$order->driverLastName}} {{$order->driverFirstName}}</td>
                                                </tr>
                                            <input type="hidden" name="orderIds[]" value="{{$order->orderId}}"/>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-2">
                                <table class="table table-info text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">Lieferaddress</th>
                                        <th scope="col">Besteluungs-Datum</th>
                                        <th scope="col">RechnugsNr</th>
                                    </tr>
                                    </thead>
                                    @php
                                    $orderDate=new DateTime($order->orderDate);
                                    @endphp
                                    <tbody>
                                        <td>{{$order->daLastName}} {{$order->daFirstName}}<br>{{$order->street}} {{$order->hausNr}}<br> {{$order->city}} {{$order->plz}}</td>
                                        <td>{{$orderDate->format('d-m-Y')}}</td>
                                        <td>{{$order->invoiceId}}</td>
                                    </tbody>
                                </table>
                            </div>   
                            <div class="tables-footer text-center">
                                <div class="select">
                                    <label for="">Wählen Sie bitte ein Fahrer aus</label>
                                    <select name="driverId">
                                        <option></option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{$driver->id}}">{{$driver->driverLastName}} {{$driver->driverFirstName}},{{$driver->id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="choose mt-3">
                                    <input type="hidden" value="{{$order->invoiceId}}" name="invoiceId">
                                    <button type="submit" class="btn btn-danger">Bestätigung</a> 
                                </div>
                                @if(!empty(Session::get('stsError')) && Session::get('invoiceId')==$order->invoiceId)
                                <div>
                                    <small class="text-danger">{{Session::get('stsError')}} </small>
                                </div>
                                @endif 
                            </div>
                        </div>  
                    </form>   
                    @php
                        $orderIds=array();    
                    @endphp       
                @endforeach 
            </div>
        </div>
    </div>
@endsection