@php
    $totalPrice=0;
@endphp
@extends('app')
@section('content')
    <div class="accordion" id="accordionExample">
        <div class="myOrders-index">
            @foreach ($invoices as $invoice) 
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{$invoice[0]->orderId}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$invoice[0]->orderId}}" aria-expanded="true" aria-controls="collapseOne">
                        {{$invoice[0]->orderDate}}
                    </button>
                </h2>
                <div id="collapse{{$invoice[0]->orderId}}" class="accordion-collapse collapse " aria-labelledby="heading{{$invoice[0]->orderId}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="invoice">   
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>Artikel</th>
                                        <th>Foto</th>
                                        <th>Bestellte Anzahl</th>
                                        <th>Preis</th>
                                        <th>Zustand der Bestellung</th>
                                        <th class="text-center">Bestätigen</th>
                                        <th>Lieferungsdetails</th>
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
                                            @if($order->orderDelivered=='no')
                                                @if($order->cancelDecision=='admin')
                                                    <td class="text-danger">Stöniert</td>
                                                @else
                                                    <td class="text-warning">Am arbeiten</td>
                                                @endif
                                                <td>---</td>
                                                <td>---</td>
                                            @else
                                                @if(empty($order->demagedArticle))
                                                    <td class="text-success">{{$order->toDeliverCount}} Artikel(n) zugestellt</td> 
                                                @else
                                                    <td class="text-danger">{{$order->articleCount-$order->toDeliverCount}} Artikel(n) zugestellt</td> 
                                                @endif
                                                @if(($order->demagedArticle+$order->noAcceptCount+$order->yesAcceptCount+$order->demagedAcceptCount)<$order->articleCount)
                                                    <td> <a class="btn btn-success" href="{{Route('myOrders.acceptOrder',['answer'=>'yes','orderId'=>$order->orderId])}}">Ja</a> <a class="btn btn-danger" href="{{Route('myOrders.acceptOrder',['answer'=>'no','orderId'=>$order->orderId])}}">Nein or Unvollstängig</a> <a class="btn btn-warning" href="{{Route('myOrders.acceptOrder',['answer'=>'demaged','orderId'=>$order->orderId])}}">Beschädigt</a></td>
                                                @else 
                                                    <td class="text-danger text-center">---</td>
                                                @endif
                                                <td><a href="{{Route('myOrders.details',['orderId'=>$order->orderId])}}" class="btn btn-light">Details</a></td>
                                            @endif
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <table class="table table-dark table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th >Lieferadresse</th>
                                        <th>Datum der Bestellung</th>
                                        <th>Datum der Zustellung</th>
                                        <th >Gesamt Preis</th>
                                        <th>Rechnung-Nr</th>
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
                                    <td >{{$order->invoiceId}}</td>
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @php
            $totalPrice=0;
             @endphp
            @endforeach
        </div>        
    </div>
@endsection