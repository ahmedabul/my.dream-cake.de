<div class="accept-order">
    <div class="container">
        <form action="{{Route('myOrders.comment')}}" method="POST">
            @csrf 
              <input type="hidden" name="orderId" value="{{$article->orderId}}">
            <div class="header">
                <h2 class="text-center text-danger articleName"><ins>{{$article->articleName}}</ins></h2>
                <h2 class="text-center"><ins>Ihre Meinung liegt uns am Herzen!</ins></h2>
                <img src="{{$article->mainPhoto}}" alt="">
            </div>
            <div class="body mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <span style="font-size: 35px">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </span>
                        <span style="font-size: 20px"> 
                            {{Auth::guard('customer')->user()->lastName}} {{Auth::guard('customer')->user()->firstName}},
                        </span>
                    </div>
                        <p>Dieses Produkt bewerten.</p>
                    
                    <div class="mt-2 col-md-6">
                        <h5>Kundenrezensionen {{$article->articleName}}
                        @for($i=0;$i<=4;$i++)
                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                        @endfor
                        </h5>
                        @for ($i = 0; $i < 5; $i++)
                        <div class="form-check">
                            @if ($i==0) 
                            <input class="form-check-input" type="radio" name="stars" value="{{$i+1}}">
                            <label class="form-check-label" for="flexRadioDefault1">{{$i+1}} Stern</label>
                            @else
                            <input class="form-check-input" type="radio" name="stars" value="{{$i+1}}">
                            <label class="form-check-label" for="flexRadioDefault1">{{$i+1}} Sterne</label>
                            @endif
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:{{$i*25}}%" aria-valuenow="{{$i*25}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="col-md-6">
                        <h5 class="mt-2">Sagen Sie Ihre Meinung zu diesem Artikel.</h5>
                        <textarea name="customerComment" placeholder="...." maxlength="300">{{ old('customerComment') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <button class="btn btn-danger w-50" type="submit">Speichern</button>
            </div>
        </form>
    </div>
</div> 