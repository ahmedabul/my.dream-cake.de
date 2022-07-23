@extends('app')
@section('content')
    <div class="order-goToResearch" >
        <div class="container">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                  <h5 class="card-title">Bestellung-Suchen</h5>
                  <h6 class="card-subtitle mb-2 text-muted">Geben Sie bitte eine Rechnungsnummer an. Sie Können auch die Nachname des Kunden verwenden, um die Daten zu ermitteln</h6>
                  <div class="blockquote-footer">Für den Testvorgang können Sie gerne Rechnungsnummer:60 oder Nachname: schmidt verwenden.</div>
                  <input class="mt-4" name="research" placeholder="Rechnung-Nr ...">
                </div>
            </div>
            @if(!empty(Session::get('emailSent')))
                <div class="text-success text-center">
                    <p>{{Session::get('emailSent')}}</p>
                </div>
                @endif
            <div class="line"></div>
            <div class="body"> 

            </div>
        </div>
    </div>
 
@endsection

