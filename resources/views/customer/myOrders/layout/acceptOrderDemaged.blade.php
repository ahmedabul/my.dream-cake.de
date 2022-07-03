<div class="accept-order">
    <div class="container"> 
        <form action="{{Route('myOrders.comment')}}" method="POST">
            @csrf 
            <input type="hidden" name="comment" value="demaged">
            <input type="hidden" name="orderId" value="{{$article->orderId}}">
            <div class="header">
                <h2 class="text-warning text-center articleName"><ins>{{$article->articleName}}</ins></h2>
                <img src="{{$article->mainPhoto}}" alt="">
                <h5 class="mt-3">Es tut uns wirklich leid, dass die Lieferung beschädigt bei ihnen angekommen ist.</h5>
                <p>Bitte nehmen Sie sich ein paar Minuten Zeit, um die folgende Umfrage auszufüllen.</p>
            </div>
            <div class="body">
                <h4>Laut unserem System wurde(n) {{$article->articleCount-$article->demagedArticle}} Artikel(n) von Produkt {{$article->articleName}} zugestellt.</h4>
                <p>Wie Viele Artikeln sind davon beschädigt?</p>
                @for($i=0;$i<$countAcceptedArticles;$i++)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="article" id="flexRadioDefault1" value="{{$i+1}}">
                    <label class="form-check-label" for="flexRadioDefault1">
                    @if($i==0)
                        {{$i+1}} Artikel
                    @else
                        {{$i+1}} Artikeln 
                    @endif
                    </label>
                </div>
                @endfor
            </div>
            <div class="footer">
                <div class="text-center">
                    <button class="btn btn-warning w-50 mt-2" type="submit">Speichern</button>
                </div>
            </div>
        </form>
    </div>
</div>