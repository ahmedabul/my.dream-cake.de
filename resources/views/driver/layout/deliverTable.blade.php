<form method="post" action="{{Route('driver.deliverConfirm')}}">
    @csrf
    <div class="row justify-content-center">
        <table class="table w-50 col-md-12">
            <thead>
            <tr>
                <th>Rechnung-Nr</th>
                <th>Bestellung-Nr</th>
                <th scope="col">Artikel</th>
            </tr>
            </thead>
            <tbody> 
            @foreach ($orders as $order) 
            <tr>
                <td>{{$order->invoiceId}}</td>
                <td>{{$order->orderId}}</td>
                <td>{{$order->articleName}}</td>
                <input type="hidden" name="orderIds[]" value="{{$order->orderId}}">
            </tr>
            @endforeach
            </tbody> 
        </table>
        <input type="hidden" name="email" value="{{$order->customerEmail}}">
        <input type="hidden" name="invoiceId" value="{{$order->invoiceId}}">
        <input type="hidden" name="articlePlace" value="{{$articlePlace}}">
        
        @if($articlePlace=='neighbor')
            <div class="neighbor-info  mb-3 d-flex justify-content-center">
                <div class="ml-4">
                    <div>
                        <label>Name:</label>
                        <input type="text" name="nameOfNeighbor">
                    </div>
                </div>
                <div class="ml-4">
                    <div>
                        <label>Straße:</label>
                        <input type="text" name="streetOfNeighbor">
                    </div>
                </div>
                <div class="ml-4">
                    <div>
                        <label>HausNr:</label>
                        <input type="text" name="hausNrOfNeighbor" >
                    </div>
                </div>
            </div>
        @endif
        <div class="text-center"> 
            <button type="submit" class="btn btn-success w-50 btn-driver-delivered">Bestätigen</button>
        </div>
    </div>
   
</form>