@extends('app') 
@section('content')
    <div class="cancel-form">
        <form method="POST" action="{{Route('order.cancel')}}">
            @csrf
            <input type="hidden" name="orderId" value={{$order->id}}>
            <input type="hidden" name="email" value={{$email}}>
                <div class="header">
                    <h2>Stornierung einer Bestellung</h2> 
                </div>
                <div class="question-1">
                    <label>hier Können Sie dem Kunden benachrichtigen, warum die Bestellung storniert wird</label>
                    <textarea class="w-100" name="reasonCancel">{{Session::get('reasonCancel')}}</textarea>
                </div>
   
                <div class="text-center mt-3"><button type="submit" class="btn btn-danger w-50">Stornieren</button></div>
                <div class="text-center mt-3"><a href="{{Route('order.show',['orderId'=> $order->id])}}" class="btn btn-dark w-50">Zurück</a></div>
                @if(!empty(Session::get('sts')))
                <h5 class="text-danger text-center">{{Session::get('sts')}}</h5>
                @endif
        </form>
    </div>
@endsection