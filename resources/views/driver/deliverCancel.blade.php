@extends('app') 
@section('content')
    <div class="deliver-cancel">
        <div class="cover">
            <h2 class="text-danger">Stornierung-Fourm</h2>
            <form class="deliver-cancel-form mt-3" action="{{Route('driver.cancelConfirm')}}" method="POST" >
                @csrf
                <input type="hidden" value="{{$orderId}}" name="orderId">
                <input type="hidden" value="{{$toDeliverCount}}" name="toDeliverCount">
                @if($toDeliverCount>1)
                    <div class="quation1">
                        <h4 class="text-danger">Sie haben von dieser Produktsart {{$toDeliverCount}} Artikelen zu liefern.</h4>
                        <label>Wie viel Artikel wöllen Sie stornieren</label>
                        @for($i=0;$i<$toDeliverCount;$i++)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="demagedArticle" value="{{$i+1}}">
                            @if($i==0)
                            <label class="form-check-label" for="cancelCount" value="{{$i+1}}">
                            {{$i+1}} Artikel
                            </label>
                            @else 
                            <label class="form-check-label" for="cancelCount" value={{$i+1}}>
                                {{$i+1}} Artikelen
                            </label>
                            @endif
                        </div>
                        @endfor
                    </div>
                @endif
                @if($toDeliverCount==1)
                <input type="hidden" name="demagedArticle" value=1>
                @endif
                <div class="quation2 mt-2">
                    <label>Begründen Sie Ihre Stornierung</label>
                    <select class="form-select" aria-label="Default select example" name="reasonCancel">
                        <option value="0"></option>
                        <option value="auf Wunsch der Kunde"> Auf Wunsch der Kunde storniere ich die Bestellung </option>
                        <option value="beschädigt">Die Bestellung ist leider beschädigt</option>
                        <option value="keine Zeit">Keine Zeit</option>
                    </select>
                </div>
                <div class="text-center mt-2">
                    <button class="btn btn-danger w-75">Bestätigung</button>
                </div>
            </form>
            @if(!empty(Session::get('sts')))
                <h5 class="text-danger text-center">{{Session::get('sts')}}</h5>
            @endif
        </div>
    </div>
@endsection