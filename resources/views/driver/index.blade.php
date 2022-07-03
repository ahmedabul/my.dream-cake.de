@extends('app')
@section('content')
<div class="driversOrders">
    <div class="container">
        @foreach ($invoices as $invoice)
        <div class="row">
            <div class="col-md-6 orders-table">
                <table class="table table-dark table-hover text-center"> 
                    <thead>
                        <tr>
                          <th scope="col">Artikel</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Anzahl</th>
                          <th> Stönieren</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @foreach ($invoice as $order)
                        <tr>
                            <td>{{$order->articleName}}</td>
                            <td><img src="{{$order->mainPhoto}}"></td> 
                            @if(empty($order->demagedArticle))
                            <td>{{$order->articleCount-$order->yesAcceptCount-$order->demagedArticle}}</td>
                            @else
                            <td class="text-danger">{{$order->articleCount-$order->yesAcceptCount-$order->demagedArticle}} <br>Sie haben {{$order->toDeliverCount}}Artikel(n) stöniert</td>
                            @endif
                            <td><a href="{{Route('driver.deliverCancel',['orderId'=>$order->orderId])}}" class="btn btn-danger" >Stornieren</a></td>
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
                    <a href="{{Route('driver.deliver',['invoiceId'=>$order->invoiceId])}}" class="btn btn-success w-75">Zustellen</a>
                </div>

            </div>
        </div>
        <div class="line"></div>
        @endforeach
    </div>
</div>
@endsection