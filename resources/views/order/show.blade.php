@extends('app')
@section('content')
    <div class="order-show" style="margin-top: 150px">
        <table class="table table-dark text-center">
            <thead>
                <tr>
                  <th>Article</th>
                  <th>Foto</th>
                  <th>Preis</th>
                  <th>BestellteAnzahl</th>
                  <th>orderDelivered</th>  
                </tr>
              </thead>
              <tbody>
                <tr> 
                    <td>{{$order->articleName}}</td>
                    <td><img src="{{$order->mainPhoto}}" style="width: 50px; height:50px"></td>
                    <td>{{$order->price}}€</td> 
                    <td>{{$order->articleCount}}</td>
                    <td>{{$order->orderDelivered}}</td>
                  </tr>
              </tbody>
        </table>
        <table class="table table-dark text-center">
          <thead>
              <tr>
                <th>demagedArticle</th>
                <th>noAcceptCount</th>
                <th>demagedAcceptCount</th>
                <th>cancelCount</th>

              </tr>
          </thead>
          <tbody>
            <tr>
              @if (!empty($order->demagedArticle))
              <td>{{$order->demagedArticle}}</td>
              @else
                  <td>--</td>
              @endif

              @if($order->orderDelivered=='yes')
              <td> 
                <p class="text-warning">{{$order->noAcceptCount}}</p>
                <select  id="noAcceptCount" name="noAcceptCountt" orderId="{{$order->orderId}}">
                 <option value="null"></option>
                 <option value="unlock">Frei Schalten</option>
                  @for ($i = 0; $i < ($order->articleCount-$order->demagedArticle)-($order->noAcceptCount+$order->demagedAcceptCount+$order->cancelCount); $i++)
                    <option value="{{$i+1}}">{{$i+1}}Artikeln</option>
                  @endfor
                </select>
              </td>
              @else
                <td>--</td>
              @endif

            @if($order->orderDelivered=='yes')
            <td> 
              <p class="text-warning">{{$order->demagedAcceptCount}}</p>
              <select name="demagedAceptCount" id="demagedAcceptCount" orderId="{{$order->orderId}}">
               <option value="null"></option>
               <option value="unlock">Frei Schalten</option>
                @for ($i = 0; $i < ($order->articleCount-$order->demagedArticle)-($order->noAcceptCount+$order->demagedAcceptCount+$order->cancelCount); $i++)
                  <option value="{{$i+1}}">{{$i+1}}Artikeln</option>
                @endfor
              </select>
            </td>
            @else
              <td>--</td>
            @endif
            @if (!empty($order->cancelCount))
            <td>
              <p class="text-danger">{{$order->cancelCount}}</p>
              <p><a class="btn btn-danger" orderId="{{$order->orderId}}" id="cancelCount-unlock-btn">Frei Schalten</a></p>
            </td>  
            @else
                 <td>--</td>
            @endif
            </tr>
          </tbody>
        </table>
        <table class="table table-dark text-center">
          <thead>
              <tr>
                <th>cancelDecision</th>
                <th>reasonCancel</th>
                <th>adminReaktion</th>
                <th >articlePlace</th>
              </tr>
          </thead>
          <tbody>
            <tr>
          @if (!empty($order->cancelDecision))
          <td>{{$order->cancelDecision}}</td>  
          @else
               <td>--</td>
          @endif
                       
          @if (!empty($order->reasonCancel))
          <td>{{$order->reasonCancel}}</td>
          @else
            <td>--</td>
          @endif
          @if (!empty($order->adminReaktion))
          <td>{{$order->adminReaktion}}</td>
          @else
               <td>--</td>
          @endif
          @if (!empty($order->articleCount))
          <td>{{$order->articlePlace}}</td>
          @else
               <td>--</td>
          @endif
          <tr>
          </tbody>
    </table>
        <div class="text-center">
          <a href="{{Route('order.goToResearch')}}" class="btn btn-dark w-25 w-25 ml-3">Zurück</a>
          <a  href="{{Route('order.cancelForm',['orderId'=>$order->orderId,'email'=>$order->email])}}" class="btn btn-danger w-25 w-25">Stönieren</a>

        </div> 
    </div>
@endsection