@extends('app')
@section('content')
<div class="myorders-details" style="margin-top: 100px">
    <div class="card text-center">
        <div class="card-header">
       <h2> Details zu Ihrer Bestellung</h2>
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>BestellungNr: {{$order->orderId}}</p>
            <footer class="blockquote-footer">Vermisste oder beschädigte Artikeln wurden von der zugestellten Anzah berücksichtigt </footer>
          </blockquote>
        </div>
    </div>
    <table class="table text-center mt-5">
        <thead>
        <tr>
            <th scope="col">BestellungNr</th>
            <th scope="col">Bestellte Anzahl</th>
            <th>Artikeln zu liefern</th>
            <th scope="col" class="text-danger">Vermisst</th>
            <th scope="col" class="text-warning">Beschädigt</th>
            <th scope="col" class="text-success">Erhalten</th>
        </tr>
        </thead>
        <tbody>
            <tr>
            <th >{{$order->orderId}}</th>
            <td>{{$order->articleCount}}</td>
            @php
            $toDeliver=$order->demagedArticle+$order->demagedAcceptCount+$order->noAcceptCount;
            @endphp
            <td>{{$toDeliver}}</td>
            @if (empty($order->noAcceptCount))
                <td>--</td>
            @else
            <td class="text-danger">{{$order->noAcceptCount}}</td>
            @endif
            @if (empty($order->demagedAcceptCount))
                <td>--</td>
            @else
            <td class="text-warning">{{$order->demagedAcceptCount}}</td>
            @endif
            @if (empty($order->yesAcceptCount))
            <td>--</td>
            @else
            <td class="text-success">{{$order->yesAcceptCount}}</td>
            @endif
            </tr>
        </tbody>
    </table>
    <div class="card text-center mt-5">
        <div class="card-header">
        <h4>Wo sind Ihre Bestellung geliefert..</h4>
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <footer class="blockquote-footer">{{$order->articlePlace}}</footer>
        </div>
    </div>
    <div class="text-center mt-5">
        <a href="{{Route('myOrders.index')}}" class="btn btn-dark w-25">zurück</a>
    </div>
</div>
    
@endsection