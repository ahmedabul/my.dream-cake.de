@component('mail::message')
<h2 style="text-align: center">SaraJolie </h2>
Folgende Bestellung wurde stöniert
@component('mail::table')
| Artikel                 | Menge             | Prris             |
|:-----------------------: |:------------------|:------------------:|
|{{$order->articleName}}   | {{$order->articleCount}} | {{$order->price}}€ | 
@endcomponent
<h3>Rechnung-Nr:{{$order->invoiceId}}</h3>
<h2>Grund der Stönierung:</h2>
<p>{{$reasonCancel}}</p>   
<h2>Aufgrund der oben genannten Gründe/Grund wird folgendes Verfahren ausgeführt:</h2> 
<p>{{$adminReaktion}}</p>
@endcomponent

 