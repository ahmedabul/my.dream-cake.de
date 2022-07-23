@component('mail::message')
<h2 style="text-align: center">SaraJolie </h2>
Danke für Ihre Bestellung
@component('mail::table')
| Artikel                 |  Prris             |
|:-----------------------: |:------------------:|
@foreach($orders as $order)
|{{$order->articleName}}   | {{$order->price}}€ |
@endforeach
@endcomponent
<h3>Rechnung-Nr:{{$order->invoiceId}}</h3>
<h3>Lieferaddress:</h3>
<p>{{$order->daLastName}} {{$order->daFirstName}}<br>{{$order->street}} {{$order->hausNr}} <br>{{$order->city}} {{$order->plz}}</p>     
@endcomponent
