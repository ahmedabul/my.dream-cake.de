@extends('app')
@section('content')
    <div class="order-show" style="margin-top: 150px">
      <div class="container"> 
        <div class="row">
          <div class="customer-data col-md-6 text-center">
            <p><i class="fa fa-user-circle" aria-hidden="true" style="font-size: 40px;"></i><span style="font-size: 30px;border-bottom:1px solid black">Kunde Daten</span></p>
            <p  style="font-size: 20px; margin-left:40px">{{$customerAddres->lastName}} {{$customerAddres->firstName}}<br>
              {{$customerAddres->street}} {{$customerAddres->hausNr}}<br>
              {{$customerAddres->city}} {{$customerAddres->plz}}
            </p>
          </div>
          <div class="deliveryAddress col-md-6">
            <p><i class="fa fa-truck" aria-hidden="true" style="font-size: 40px;"></i><span style="font-size: 30px;border-bottom:1px solid black">Lieferadresse</span></p>
            <p  style="font-size: 20px; margin-left:40px">{{$order->lastName}} {{$order->firstName}}<br>
              {{$order->street}} {{$order->hausNr}}<br>
              {{$order->city}} {{$order->plz}}
            </p>
          </div>
        </div>
        <table class="table mt-5">
          <thead>
            <tr>
              <th scope="col">Rechnung-Nr</th>
              <th scope="col">Bestellung-Nr</th>
              <th scope="col">Article</th>
              <th scope="col">Versuch-Nr</th>
              <th>Zustand der Bestellung</th>
              <th>Lieferungsdetails</th>
              <th>Bestätigung des Kunden</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>{{$order->invoice_id}}</th> 
              <td>{{$order->orderId}}</td>
              <td>{{$order->articleName}}</td>
              <td>{{$order->tryCount}}</td>
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
                  <td class="text-success"><h2><i class="fa fa-check" aria-hidden="true"></i></h2><small>angenomen</small></td>
                  @elseif($order->damaged=='1')
                  <td class="text-warning"><h2><i class="fa fa-frown" aria-hidden="true"></i></h2><small>beschädigt</small></td>
                  @elseif($order->noAccept=='1')
                  <td class="text-danger"><h2><i class="fa fa-times" aria-hidden="true"></i></h2><small>NICHT angenomen</small></td>
                  @else
                  <td style="width: 250px">Der Kunde hat sich nicht reagiert</td>
                  @endif
                  
              @endif
          @endif
            </tr>
          </tbody>
        </table>
      </div>
        <div class="text-center">
          <a href="{{Route('order.goToResearch')}}" class="btn btn-dark w-25 w-25 ml-3">Zurück</a>
          <a  href="{{Route('order.cancelForm',['orderId'=>$order->orderId,'email'=>$order->email])}}" class="btn btn-danger w-25 w-25">Störnieren</a>
        </div> 
    </div>
@endsection