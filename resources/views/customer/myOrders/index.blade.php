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
                        {{date('d-m-Y', strtotime($invoice[0]->orderDate))}}
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
                                        <th>Preis</th>
                                        <th>Zustand der Bestellung</th>
                                        <th>Lieferungsdetails</th>
                                        <th>Bestätigen</th>
                                    </tr>
                                </thead>
                                @foreach ($invoice as $order)
                                    <tbody>
                                        <tr>
                                            <td >{{$order->articleName}}</td>
                                            <td><img src="{{$order->mainPhoto}}"></td>
                                            <td>{{$order->price}}€</td>
                                            @php 
                                                $totalPrice+=$order->price;
                                            @endphp
                                            @if($order->ready=='0')
                                                <td class="text-warning">Am arbeiten <i class="fa fa-birthday-cake" aria-hidden="true"></i></td>
                                                <td>---</td>
                                                <td>---</td>
                                            @else
                                                @if($order->delivered==0)
                                                    <td class="text-warning">Unterwegs <i class="fa fa-truck" aria-hidden="true"></i></td>
                                                    <td>---</td>
                                                    <td>---</td>
                                                @else
                                                    <td class="text-success">Zugestellt <i class="fa fa-thumbs-up" aria-hidden="true"></i></td>
                                                    <td><small>{{$order->articlePlace}}</small></td>
                                                    @if($order->accept=='1')
                                                    <td class="text-success"><h2><i class="fa fa-check" aria-hidden="true"></i></h2></td>
                                                    @elseif($order->damaged=='1')
                                                    <td class="text-warning"><h2><i class="fa fa-frown" aria-hidden="true"></i></h2></td>
                                                    @elseif($order->noAccept=='1')
                                                    <td class="text-danger"><h2><i class="fa fa-times" aria-hidden="true"></i></h2></td>
                                                    @else
                                                    <td style="width: 250px"><small>Haben Sie Ihre Sendung angenomen?</small><br><a class="btn btn-success" href="{{Route('myOrders.acceptOrder',['answer'=>'yes','orderId'=>$order->orderId])}}">Ja</a> <a class="btn btn-danger" href="{{Route('myOrders.acceptOrder',['answer'=>'no','orderId'=>$order->orderId])}}">Nein</a> <a class="btn btn-warning" href="{{Route('myOrders.acceptOrder',['answer'=>'damaged','orderId'=>$order->orderId])}}">beschädigt</a></td>
                                                    @endif
                                                    
                                                @endif
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