@extends('app')
@section('content')
    <div class="form" style="margin-top: 100px">
        @if($answer=='yes')
            @include('customer.myOrders.layout.acceptOrderYes') 
        @elseif($answer=='demaged')
            @include('customer.myOrders.layout.acceptOrderDemaged') 
        @else
             @include('customer.myOrders.layout.acceptOrderNo')
        @endif
        <div class="text-center">
            <a href="{{Route('myOrders.index')}}" class="btn btn-dark w-25">zurück</a>
        </div>
        @if(!empty(Session::get('sts')))
            <div class="sts text-danger text-center mb-5"> 
                <h4>{{Session::get('sts')}}</h4>
            </div>
        @endif
    </div>
@endsection 