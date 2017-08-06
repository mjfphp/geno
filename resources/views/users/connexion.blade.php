@extends('layouts.app')

@section('style')
  <link href="css/connexion.css" rel="stylesheet" type="text/css">
@endsection

@section('title')
	Prof name
@stop

@section('header_title')
  Bienvenue
@endsection

@section('content')
  <div class="container">
    <div class="login-page">
      <div class="form">

         <form class="login-form"  method="post" action="/">
        {{ csrf_field() }}
          <img id="profile-img" class="profile-img-card" src="images/ensa.png" />

          <input class="dd" type="text" name="email" placeholder="email" value="{{ old('email') }}" autofocus requierd/>

          <input class="dd" type="password" name="password" placeholder="password" required />
          <div class="hold">
                 <input type="checkbox" id="test5"/>
                 <label for="test5">Remember Me</label>
          </div>
          <button>login</button>
          <p class="message"><a href="#">Mot de Pass Oublié ?</a></p>
            </br>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-dismissible alert-danger">
                        {{$error}}
                    </div>
                @endforeach
            @endif

            @if(Session::has('erreur'))
               <div class="alert alert-warning" role="alert">
                    <strong>{{Session::get('erreur')}}</strong>
              </div>
            @endif


        </form>
     </div>
    </div>
  </div>
@endsection
