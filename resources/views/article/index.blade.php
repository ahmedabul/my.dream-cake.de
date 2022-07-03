@extends('app') 
@section('content')
<div class="content d-flex justify-content-center" style="margin-top: 7%">
    <div class="articleIndex">
        <div class="auth-articleIndex">
            <div class="row">
                <h1>Artikel Suchen</h1>
                <div class="col-12">
                    <div class="auth-textBox">
                        <input type="text" placeholder="Geben Sie den Artikelname oder das Artikel-Id"  class="articleSearch">
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<div class="researched-articles">
    <div class="container">
        <div class='row articles'>

        </div>
    </div>
</div>

</div> 
@endsection