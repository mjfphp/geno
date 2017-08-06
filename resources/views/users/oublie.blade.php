@extends('layouts.app')

@section('style')
  <link href="css/oublie.css" rel="stylesheet" type="text/css">
@endsection

@section('title')
	Récupération
@stop

@section('js')
  <script type="text/javascript" src="js/oublie.js">

  </script>
@stop
@section('header_title')
  Récupération de Votre Compte
@endsection

@section('content')
  <div class="container">
    <div class="wrap">
      <form class="form" action="#" method="post">
        <input type="email" name="email" placeholder="Email de récupération">
        <button class="btn" type="submit" name="button">Envoyer</button>
      </form>
    </div>
  </div>
@endsection
