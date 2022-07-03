@extends('app') 
@section('content')
    <div class="cancel-form">
        <form method="POST" action="{{Route('order.cancel')}}">
            @csrf
            <input type="hidden" name="orderId" value={{$order->id}}>
            <input type="hidden" name="email" value={{$email}}>
                <div class="header">
                    <h2>Stönieren-Form</h2>
                </div>
                <div class="question-1">
                    <label> Begründen Sie der Kunde, warum Sie die Bestellung stönieren wöllen</label>
                    @if(empty($order->reasonCancel))
                    <textarea class="w-100" name="reasonCancel">{{Session::get('reasonCancel')}}</textarea>
                    @else
                    <textarea class="w-100" name="reasonCancel">{{$order->reasonCancel}}</textarea>
                    @endif
                </div>
                <div class="question-2">
                    <label>Welche verfahren werden deswegen ausgeführt </label>
                    @if(empty($order->adminReaktion))
                    <textarea class="w-100" name="adminReaktion">{{Session::get('adminReaktion')}}</textarea>
                    @else
                    <textarea class="w-100" name="adminReaktion">{{$order->adminReaktion}}</textarea>
                    @endif
                </div>
                <div class="question-3">
                    <label>Wie viel Artikel wöllen Sie Stönieren </label>
                    <select name="cancelCount">
                        <option></option>
                         @for ($i = 0; $i < ($order->articleCount)-($order->noAcceptCount+$order->demagedAcceptCount+$order->cancelCount); $i++)
                           <option value="{{$i+1}}">{{$i+1}}Artikeln</option>
                         @endfor
                       </select>
                </div>
                <div class="text-center mt-3"><button class="btn btn-danger w-50">Stönieren</button></div>
                <div class="text-center mt-3"><a href="{{Route('order.show',['orderId'=> $order->id])}}" class="btn btn-dark w-50">Zurück</a></div>
                @if(!empty(Session::get('sts')))
                <h5 class="text-danger text-center">{{Session::get('sts')}}</h5>
                @endif
        </form>
    </div>
@endsection