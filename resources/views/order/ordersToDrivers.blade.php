@extends('app') 
@section('content')
    <div class="orders-to-drivers">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($invoices as $invoice)
                <form class="invoice col-lg-5" action="{{Route('order.orderDriverSave')}}" method="POST">
                    @csrf
                    <div class="order-table">
                        <table class="table table-dark table-hover text-center"> 
                            <thead>
                                <tr>
                                  <th scope="col">Artikel</th>
                                  <th scope="col">Foto</th>
                                  <th scope="col">Anzahl</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                @foreach ($invoice as $order)
                                <input type="hidden" name="invoiceId" value="{{$order->invoiceId}}">
                                <tr>
                                    <td>{{$order->articleName}}</td>
                                    <td><img src="{{$order->mainPhoto}}"></td>
                                    <td>{{$order->articleCount}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                    <div class="address-table">
                        <table class="table table-dark table-hover text-center"> 
                            <thead>
                                <tr>
                                  <th scope="col">Name</th>
                                  <th scope="col">Vornam</th>
                                  <th scope="col">Addresse</th>
                                  <th>Rechnung-Nr</th>
                                  <th>Fahrer</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr>
                                    <td>{{$order->firstName}}</td>
                                    <td>{{$order->lastName}}</td>
                                    <td>{{$order->street}} {{$order->hausNr}}, {{$order->city}} {{$order->plz}}</td>
                                    <td>{{$order->invoiceId}}</td>
                                    @if(empty($order->driver_id))
                                    <td>--</td>
                                    @else 
                                    <td>{{$order->driverFirstName}} {{$order->driverLastName}}, {{$order->driver_id}}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="driver-chose">
                        <div class="chose">
                            <label for="">Fahrer auswählen</label>
                            <select class="form-select" aria-label="Default select example" name="driverId">
                                <option> </option> 
                                @foreach ($drivers as $driver)
                                    <option value={{$driver->id}}>{{$driver->driverLastName}} {{$driver->driverFirstName}}, {{$driver->id}} </option> 
                                @endforeach 
                            </select>
                        </div>
                        <div class="btn-ok mt-3">
                            <button type="submit" class="btn btn-danger w-100">Bestätigen</button>
                        </div>
                        <div class="driver-infos">
                            <div class="row">
                                <div class="driver-name col-md-12 text-center fw-bold">
                                    {{$order->driverFirstName}} {{$order->driverLastName}}, {{$order->driver_id}}
                                </div>
                            </div>
                        </div>
                        @if(!empty(Session::get('stsError')))
                        <div class="text-center">
                            @if(Session::get('invoiceId')==$order->invoiceId)
                            <small class="text-danger">{{Session::get('stsError')}}</small>
                            @endif
                        </div>
                        @endif
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection