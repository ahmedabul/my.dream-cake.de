<div class="accept-order">
    <div class="container">
        <form action="{{Route('myOrders.comment')}}" method="POST">
            @csrf 
              <input type="hidden" name="comment" value="yesAccept">
              <input type="hidden" name="orderId" value="{{$article->orderId}}">
            <div class="header">
                <h2 class="text-center text-success articleName"><ins>{{$article->articleName}}</ins></h2>
                <img src="{{$article->mainPhoto}}" alt="">
                <h2 class="text-center"><ins>Ihre Meinung liegt uns am Herzen!</ins></h2>
                <p class="text-center">Bitte nehmen Sie sich ein paar Minuten Zeit, um die folgende Umfrage auszufüllen.</p>
            </div>
            <div class="body">
                <h4 class="text-center">Laut unserem System  wurde(n) {{$article->articleCount-$article->demagedArticle}} Artikel(n) von Produkt {{$article->articleName}} zugestellt.</h4>
                <h4 class="mt-5">Wie viele Artikeln haben Sie angenohmen?</h4>
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
                <div class="mt-2">
                  <h4>Wie viele Sterne geben Sie dem Artikel {{$article->articleName}}</h4>
                  @for ($i = 0; $i < 5; $i++)
                  <div class="form-check">
                    @if ($i==0)
                    <input class="form-check-input" type="radio" name="stars" value="{{$i+1}}">
                    <label class="form-check-label" for="flexRadioDefault1">{{$i+1}} Stern</label>
                    @else
                    <input class="form-check-input" type="radio" name="stars" value="{{$i+1}}">
                    <label class="form-check-label" for="flexRadioDefault1">{{$i+1}} Sterne</label>
                    @endif
                  </div>
                  @endfor
                </div>
                  

                <h4 class="mt-2">Bewerten Sie bitte das Artikel {{$article->articleName}}</h4>
                <textarea name="customerComment" placeholder="Das Artikel '{{$article->articleName}}' ...." maxlength="300"></textarea>
            </div>
            <div class="footer">
                <div class="text-center">
                <button class="btn btn-success w-50" type="submit">Speichern</button>
                </div>
            </div> 
        </form>
    </div>
</div> 