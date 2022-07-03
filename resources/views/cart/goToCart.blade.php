@php
  $totalPrice=0;  
@endphp
@extends('app') 
@section('content')
    <div class="cart">
        <div class="container">
            <table class="table table-dark table-hover text-center"> 
                <thead>
                    <tr>
                      <th scope="col">Artikel</th>
                      <th scope="col">Foto</th>
                      <th scope="col">Anzahl</th>
                      <th scope="col">Preis</th>
                      <th scope="col">Löschen</th>
                    </tr>
                </thead> 
                <tbody class="tbody">
                    @if(!empty($articles))
                    @foreach($articles as $article)
                    <tr>
                        <td >{{$article['articleName']}}</td>
                        <td><img src="{{$article['mainPhoto']}}" style="width: 70px ; height:70px"> </td>
                        <td><input class="articleCount w-100" type="number"  min="1" max="5" value="1" price="{{$article['price']}}" articleid="{{$article['id']}}"></td>
                        <td id="{{$article['id']}}" class="price">{{$article['price']}}€</td>
                        <td><a articleId="{{$article['id']}}" class="btn text-danger removeFromCart"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>
                    @php
                        $totalPrice+=$article['price'];
                    @endphp
                    @endforeach
                    @endif
                </tbody>
            </table>
            <table class="table table-dark table-borderless">
                <thead>
                  <tr>
                    <th>Lieferaddres</th>
                    <th class="text-center">Gesamt Preis</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td >
                        @if ($deliveryAddresses!=NULL)
                        <select class="form-select w-50 delivery-address-id d-inline">
                            @foreach ($deliveryAddresses as $deliveryAddress)
                                @if($loop->index==0)
                                <option selected value="{{$deliveryAddress->id}}">
                                    {{$deliveryAddress->lastName}} {{$deliveryAddress->firstName}},
                                    {{$deliveryAddress->street}} {{$deliveryAddress->hausNr}}</h5>
                                    {{$deliveryAddress->plz}} {{$deliveryAddress->city}}
                                </option>
                                @else
                                <option selected value="{{$deliveryAddress->id}}">
                                    {{$deliveryAddress->lastName}} {{$deliveryAddress->firstName}},
                                    {{$deliveryAddress->street}} {{$deliveryAddress->hausNr}}</h5>
                                    {{$deliveryAddress->plz}} {{$deliveryAddress->city}}
                                </option> 
                                @endif  
                            @endforeach    
                        </select>
                        <a href="{{Route('myProfile.deliveryAddress')}}">Neue Lieferadresse</a>
                        @else
                        ----
                        @endif
                      </td>
                      <td class="text-center totalPrice">{{$totalPrice}}€</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
            <button class="btn btn-danger w-50 btn-order">Bestellen</button>
            </div>

            <div class="no-order mt-3 text-center">
              <div class="card no-customer w-50 mx-auto">
                  <div class="card-header">
                      Sie sind nicht angemeldet
                  </div>
                  <div class="card-body">
                      <blockquote class="blockquote mb-0">
                          <p>Wenn Sie bereits ein Konto besitzen, geben Sie den aktuellen Kontonamen und das Kennwort ein, um sich anzumelden</p>
                          <footer class="blockquote-footer">Wenn Sie noch kein Konto besitzen, erstellen Sie<cite title="Source Title"> <br>ein neues Konto</cite></footer>
                      </blockquote>
                  </div>
              </div>
              <div class="card admin w-50 mx-auto">
                <div class="card-header">
                    Hallo Admin, Danke Für die Erprobung
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>Die Bestellung für ein Admin ist in unserer Seite NICHT möglich </p>
                        <footer class="blockquote-footer">Wöllen  Sie noch weiter erproben, verwenden Sie das<cite title="Source Title"> <br>USER-TEST-KONTO</cite></footer>
                    </blockquote>
                </div>
              </div>
              <div class="card customer-cart-empty w-50 mx-auto">
                <div class="card-header">
                  Ihr Warenkorb enthält keine Produkte
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>Ihr Warenkorb enthält keine Produkte.</p>
                        <footer class="blockquote-footer"> Bitte legen Sie mindestens einen Artikel in Ihren Warenkorb, um mit dem Bestellvorgang fortzufahren.</footer>
                    </blockquote>
                </div>
              </div>
            </div> 
        </div>
    </div>
@endsection


