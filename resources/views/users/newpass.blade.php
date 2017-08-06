@extends('layouts.app')

@section('style')
  <link href="css/oublie.css" rel="stylesheet" type="text/css">
@endsection

@section('title')
	Nouveau Mot De Pass
@stop

@section('js')
  <script type="text/javascript" src="js/oublie.js">

  </script>
@stop
@section('header_title')
  Nouveau Mot De Pass
@endsection

@section('content')
  <div class="container">
    <div class="wrap">
      <form class="form" action="#" method="post">
        <input type="email" name="email" placeholder="Email de récupération">
        <input type="password" name="" placeholder="Nouveau Mot de Passe">
        <input type="password" name="" placeholder="Confirmer Du Mot De Passe">
        <button class="btn" type="submit" name="button">Envoyer</button>
      </form>
    </div>
  </div>
@endsection
