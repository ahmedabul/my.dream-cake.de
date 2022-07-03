<div class="row justify-content-center">
    <table class="table w-50 col-md-12">
        <thead>
        <tr>
            <th scope="col">Artikel</th>
            <th scope="col">Anzahl</th>
            <th> Hinweisse</th>
        </tr>
        </thead>
        <tbody> 
        @foreach ($orders as $order) 
        <tr>
            <td>{{$order->articleName}}</td>
            @if(empty($order->toDeliverCount))
            <td>{{$order->articleCount}}</td>
            @else
            <td>{{$order->toDeliverCount}}</td>
            @endif
            @if(!empty($order->demagedArticle))
            <td><p class="text-danger">Sie haben {{$order->demagedArticle}} Article(s) stöniert</p></td>
            @else
            <td>--</td>
            @endif
     
        </tr>
        @endforeach
        </tbody>
    </table>
   
    <form method="post" action="{{Route('driver.deliverConfirm')}}">
        @csrf
        <input type="hidden" name="email" value="{{$order->customerEmail}}">
        <input type="hidden" name="invoiceId" value="{{$order->invoiceId}}">
        <input type="hidden" name="articlePlace" value="{{$articlePlace}}">
        @if($articlePlace=='neighbor')
            <div class="neighbor-info  mb-3 d-flex justify-content-center">
                <div class="ml-4">
                    <div>
                        <label>Name:</label>
                        <input type="text" name="nameOfNeighbor" value="{{ old('nameOfNeighbor') }}">
                    </div>
                    @if(!empty(Session::get('messages')['name']))
                    <div class="text-center w-75">
                        <small class="text-danger">{{Session::get('messages')['name'][0]}}</small>
                    </div>
                    @endif
                </div>
                <div class="ml-4">
                    <div>
                        <label>Straße:</label>
                        <input type="text" name="streetOfNeighbor" value="{{ old('streetOfNeighbor') }}">
                    </div>
                    @if(!empty(Session::get('messages')['street']))
                    <div class="text-center w-75">
                        <small class="text-danger">{{Session::get('messages')['street'][0]}}</small>
                    </div>
                    @endif
                </div>
                <div class="ml-4">
                    <div>
                        <label>HausNr:</label>
                        <input type="text" name="hausNrOfNeighbor" value="{{ old('hausNrOfNeighbor') }}">
                    </div>
                    @if(!empty(Session::get('messages')['hausNr']))
                    <div class="text-center w-75">
                        <small class="text-danger">{{Session::get('messages')['hausNr'][0]}}</small>
                    </div>
                    @endif
                </div>
            </div>
        @endif
        <div class="text-center"> 
            <button type="submit" class="btn btn-success w-50 btn-driver-delivered">Bestätigen</button>
        </div>
    </form>
   
</div>