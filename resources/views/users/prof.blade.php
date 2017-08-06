@extends('layouts.app')

@section('style')
  <link href="css/tree_menu.css" rel="stylesheet" type="text/css">
  <link href="css/material.css" rel="stylesheet">
  <link href="css/prof.css" rel="stylesheet">
@endsection

@section('title')
    Gestion des notes
@stop

@section('header_title')
    Bienvenu Professeur
@stop

@section('js')
 <script src="js/prof.js"></script>
@stop

@section('content')
    <div class="container">
        <ul class="list">
          <li class="element">
        <div class="panel panel-primary">
            <div class="panel-heading">
            <a href="/account">
                <img src="images/name.png">
            </a>
              
            </div>
          </div>

          </li>
          <li class="element">
               <div class="panel panel-primary">
            <div class="panel-heading">
            <a href="/filiere">
              <img src="images/filiere.png">
            </a>
              
            </div>
          </div>
          </li>
          <li class="element">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <a href="#" onclick="event.preventDefault();toggle(this)">
                  <img src="images/module.png">
              </a>
            </div>
            <div class="panel-body">
                <button class="btn default-btn"> Module1</button>
                <button class="btn default-btn"> Module1</button>
                <button class="btn default-btn"> Module1</button>
                    
            </div>
          </div>
          </li>
          <li class="element">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                    <a href="#" onclick="event.preventDefault();toggle(this)">
                     <img src="images/matiere.png">
                    </a>
                  </div>
                  <div class="panel-body">
                    <button class="btn default-btn"> matiere1</button>
                    <button class="btn default-btn"> matiere2</button>
                    <button class="btn default-btn"> matiere3</button>
                </div>
            </div>
          </li>
        </ul>
    </div>
@stop
