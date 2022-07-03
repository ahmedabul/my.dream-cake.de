@component('mail::message')
<h2 style="text-align: center">SaraJolie </h2>
Folgende Bestellung wurde zugestellt
@component('mail::table')
| Artikel                 | Menge             | Prris             |
|:-----------------------: |:------------------|:------------------:|
|{{$order->articleName}}   | {{$order->articleCount}} | {{$order->price}}€ |
@endcomponent
<h3>Rechnung-Nr:{{$order->invoiceId}}</h3>    
@endcomponent
