@extends('layouts.app')

@section('title')
    Gestion des notes
@stop

@section('style')
  <link href="css/matiere.css" rel="stylesheet" type="text/css">
  <link href="css/material.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('header_title')
  Nom_filiere
@endsection

@section('js')
<!-- <script src="js/matiere.js"></script>
  <!-- Compiled and minified JavaScript -->
@endsection

@section('content')
<div class="container">
    <div class="info-matiere">
        <div class="row">
            <div class="col col-md-3 col-xs-6">
                nombre de module
            </div>
            <div class="col col-md-2 col-xs-6">
                8
            </div>
            <div class="col col-md-3 col-md-offset-2 col-xs-6">
                nombre d'eleves
            </div>
            <div class="col col-md-2 col-xs-6">
                62
            </div>
        </div>
    </div>
        
    <div class="table-matiere">
        {!! csrf_field() !!}
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Apogée</th>
                    <th>Module 1</th>
                    <th>Module 2</th>
                    <th>Module 3</th>
                    <th>...</th>
                    <th>Moyenne semestre</th>
                </tr>
            </thead>
            <tbody>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td>12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td>12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td>12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td>12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td>12.3</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<diV id='log'>
</diV>
     
@stop