@component('mail::message')
<h2 style="text-align: center">My.dream-cake</h2>
Folgende Bestellung wurde stöniert
@component('mail::table')
| Artikel                  | Preis             | Bestellungsnummer|  Rechnungsnummer      |                
|:-----------------------: |:------------------|:-----------------|:----------------------|
|{{$order->articleName}}   | {{$order->price}}€| {{$order->id}}   | {{$order->invoice_id}}|
@endcomponent
<h3>Rechnung-Nr:{{$order->invoiceId}}</h3>

<p>{{$reasonCancel}}</p>   
@endcomponent

 