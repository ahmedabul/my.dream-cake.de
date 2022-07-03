@extends('app')
@section('content')
    <div class="order-return" style="margin-top: 100px">
        <div class="container">
            <div class="header">
                <h2 class="text-center text-danger">Folgende Bestellungen sollen bearbeitet werden</h2>
            </div>
            <div class="body">
                @foreach ($invoices as $invoice => $orders)
                    @php
                        $orderIds=array(); 
                    @endphp
                    <form method="POST" action="{{Route('order.orderDriverSave')}}"> 
                        @csrf 
                        <div class="tables">
                            <div class="table-1">
                                <table class="table table-dark text-center">
                                    <thead>
                                    <tr>
                                        <th>Bestell-Nr</th>
                                        <th scope="col">Artikel</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Bestelte_Anzahl</th>
                                        <th scope="col">demagedArticle</th>
                                        <th scope="col">demagedAcceptCount</th>
                                        <th>noAcceptCount</th>
                                        <th>cancelDecision</th> 
                                        <th>cancelCount</th>
                                        <th>Fahrer</th>
                                        <th class="text-danger">Vorbereitende Anzahl</th>
                                    </tr>
                                    </thead>
                                    @foreach ($orders as $order)
                                    <tbody>
                                        <td>{{$order->orderId}}</td>
                                        <td>{{$order->articleName}}</td>
                                        <td><img src="">foto</td>
                                        <td>{{$order->articleCount}}</td>
                                        @if (empty($order->demagedArticle))
                                            <td>--</td>
                                        @else
                                            <td>{{$order->demagedArticle}}</td>
                                        @endif
                                        @if (empty($order->demagedAcceptCount))
                                            <td>--</td>
                                        @else
                                        <td>{{$order->demagedAcceptCount}}</td>
                                        @endif
                                        @if (empty($order->noAcceptCount))
                                        <td>--</td>
                                        @else
                                        <td>{{$order->noAcceptCount}}</td>
                                        @endif
                                        <td>{{$order->cancelDecision}}</td>
                                        <td>{{$order->cancelCount}}</td>
                                        <td>{{$order->driverLastName}} {{$order->driverFirstName}}</td>
                                        @php
                                            $preparedArticle=$order->demagedArticle+$order->demagedAcceptCount+$order->noAcceptCount;
                                            if($preparedArticle>0)
                                            {
                                            $preparedArticle-=$order->cancelCount;
                                            }
                                            else{
                                                $preparedArticle=$order->articleCount-$order->cancelCount;
                                            }
                                            array_push($orderIds,$order->orderId);
                                        @endphp
                                        @if ($preparedArticle>0)
                                        <td class="text-danger">{{$preparedArticle}}</td>
                                        @else
                                        <td>--</td>
                                        @endif
                                    </tbody>
                                    <input type="hidden" name="orderIds[]" value="{{$order->orderId}}"/>
                                    @endforeach
                                </table>
                            </div>
                            <div class="table-2">
                                <table class="table table-info text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">Lieferaddress</th>
                                        <th scope="col">Besteluungs-Datum</th>
                                        <th scope="col">RechnugsNr</th>
                                    </tr>
                                    </thead>
                                    @php
                                    $orderDate=new DateTime($order->orderDate);
                                    @endphp
                                    <tbody>
                                        <td>{{$order->daLastName}} {{$order->daFirstName}}<br>{{$order->street}} {{$order->hausNr}}<br> {{$order->city}} {{$order->plz}}</td>
                                        <td>{{$orderDate->format('d-m-Y')}}</td>
                                        <td>{{$order->invoiceId}}</td>
                                    </tbody>
                                </table>
                            </div>   
                            <div class="tables-footer text-center">
                                <div class="select">
                                    <label for="">Wählen Sie bitte ein Fahrer aus</label>
                                    <select name="driverId">
                                        <option></option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{$driver->id}}">{{$driver->driverLastName}} {{$driver->driverFirstName}},{{$driver->id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="choose mt-3">
                                    <input type="hidden" value="{{$order->invoiceId}}" name="invoiceId">
                                    <button type="submit" class="btn btn-danger">Bestätigung</a> 
                                </div>
                                @if(!empty(Session::get('stsError')) && Session::get('invoiceId')==$order->invoiceId)
                                <div>
                                    <small class="text-danger">{{Session::get('stsError')}} Fehler</small>
                                </div>
                                @endif 
                            </div>
                        </div>  
                    </form>   
                    @php
                        $orderIds=array();    
                    @endphp       
                @endforeach 
            </div>
        </div>
    </div>
@endsection