@component('mail::message')
<h2 style="text-align: center">SaraJolie </h2>
Informationen über ihre Sendung
@component('mail::table')
| Artikel               | Bestellung-Nr     | Rechnung-Nr         |            
|:---------------------:|:-----------------:|:-------------------:|                          
@foreach($orders as $order)
|{{$order->articleName}}|{{$order->orderId}}|{{$order->invoiceId}}|  
@endforeach
@endcomponent
<h3>{{$order->articlePlace}}</h3>
<h3>Lieferaddress:</h3>
<p>{{$order->daLastName}} {{$order->daFirstName}}<br>{{$order->street}} {{$order->hausNr}} <br>{{$order->city}} {{$order->plz}}</p> 
<small>Falls die Daten dieser Lieferung stimmen nicht, können Sie innerhalb 24 Stunden diese Daten ändern</small>
@endcomponent
 