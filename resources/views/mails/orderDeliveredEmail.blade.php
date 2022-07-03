@component('mail::message')
<h2 style="text-align: center">SaraJolie </h2>
Informationen über ihre Bestellung 
@component('mail::table')
| Artikel | Bestellte Anzahl | Zugestellte Anzahl|
|:--------:|:------------------:|:----------------:|                             
@foreach($orders as $order)
| {{$order->articleName}} | {{$order->articleCount}}| {{$order->articleCount-$order->demagedArticle-$order->yesAcceptCount}}   
@endforeach
@endcomponent
<h3>Rechnung-Nr:{{$order->invoiceId}}</h3>
<h3>Lieferaddress:</h3>
<p>{{$order->daLastName}} {{$order->daFirstName}}<br>{{$order->street}} {{$order->hausNr}} <br>{{$order->city}} {{$order->plz}}</p> 
<h3>Wo hat der Fahrer ihre Artikel(n) zu gestellt</h3>  
<p>{{$order->articlePlace}}</p>  
<small>Falls die Daten dieser Lieferung stimmen nicht, können Sie innerhalb 24 Stunden diese Daten ändern</small>
@endcomponent
 