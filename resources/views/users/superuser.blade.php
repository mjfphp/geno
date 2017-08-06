@extends('layouts.app')

@section('style')
  <link  href="{{ asset('css/superuser.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header_title')
  Welcome Superuser
@endsection

@section('content')
    <div class="container">
        <ul class="list">
          <li class="element">
            <a href="/profs">
                <img src="images/prof.png">
            </a>
          </li>
          <li class="element">
            <a href="/filieres">
              <img src="images/filiere.png">
            </a>
          </li>
        </ul>
    </div>
@stop
