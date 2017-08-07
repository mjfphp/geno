@extends('layouts.app')

@section('style')
  <link  href="{{ asset('css/superuser.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header_title')
  Welcome Superuser
@endsection

@section('content')
    <div class="cont">
        <div class="searchBar">
          {{Form::open(['class' => 'form-inline','action' => 'Adminlog@home', 'method' => 'post']) }}

            <div class="form-group">
              <input type="search" class="form-control" name="search" placeholder="Search">
            </div>
            <div class="form-group">
              <select class="form-control" name="filter">
                  <option value="0" selected>Filiere-Niveaux</option>
                  <option value="1">Niveau-Modules</option>
                  <option value="2">Niveau-eleves</option>
                  <option value="3">Modules-Matieres</option>
                  <option value="4">Prof</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" name="button" class="btn btn-primary ">Search<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </div>
          {{ Form::close() }}
        </div>
         @if(session('rep'))
                       <div class="alert alert-warning" role="alert">
                            <strong>{{session('rep')}}</strong>
                      </div>
          @endif
        <div class="l">
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
    </div>
@stop
