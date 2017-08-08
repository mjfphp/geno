@extends('layouts.app')

@section('title')
    404
@stop

@section('header_title')
    {{$e->err}}
@stop

@section('style')
 <link rel="stylesheet" href="/css/erreur.css">
@stop

@section('content')
  <div class="erreur-cont">
    <div class="flex-cont">
      <h2>{{$e->msg}}</h2>

      <p>{{$e->descp}}</p>
    </div>
  </div>
@stop
