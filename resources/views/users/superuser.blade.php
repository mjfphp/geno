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
          <form class="form-inline"  action="" method="post">
            <div class="form-group">
              <input type="search" class="form-control" name="search" placeholder="Search">
            </div>
            <div class="form-group">
              <select class="form-control">
                  <option value="0" selected>Filiere</option>
                  <option value="1">Niveau</option>
                  <option value="2">Prof</option>
                  <option value="3">Eleve</option>
                  <option value="4">Module</option>
                  <option value="5">Matiere</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" name="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
            </div>
          </form>
        </div>
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
