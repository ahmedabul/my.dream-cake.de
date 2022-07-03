@extends('app')
@section('content')
<form method="POST" action="{{Route('category.add')}}" enctype="multipart/form-data">
    @csrf
    <div class="auth ">
        <div class="auth-categoryCreate">
            <div class="row">
                <h1>Kategore Erstellen</h1>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <input type="text" placeholder="Name der Kategore" name="name" value="{{ old('name') }}" maxlength="150">
                    </div>
                    @if(!empty(Session::get('messages')['name']))
                    <small class="text-danger">{{Session::get('messages')['name'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12">
                    <div class="auth-textBox">
                        <input type="text" placeholder="Logo der Kategore" name="logo" value="{{ old('logo') }}" maxlength="150">
                    </div>
                    @if(!empty(Session::get('messages')['logo']))
                    <small class="text-danger">{{Session::get('messages')['logo'][0]}}</small>
                    @endif
                </div>
                <div class ="col-12">
                    <div class="form-group mt-2">
                        <label  for="exampleFormControlFile1">Picture</label>
                        <input type="file" name="foto" class="foto text-warning" id="exampleFormControlFile1">
                    </div>
                    @if(!empty(Session::get('messages')['foto']))
                    <small class="text-danger">{{Session::get('messages')['foto'][0]}}</small>
                    @endif
                </div>
                <div class="text-center">
                    <input type="submit" class="btn-register mt-5 btn w-50" value="Neue Kategore" >
                </div>
            </div>
            @if(!empty(Session::get('sts')))
            <div>
                <h2 class="text-danger text-center">{{Session::get('sts')}} </h2>
            </div>
            @endif    
        </div>
    </div>
</form>
@endsection