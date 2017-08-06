@extends('layouts.app')

@section('title')
    Gestion des notes
@stop

@section('style')
  <link href="css/matiere.css" rel="stylesheet" type="text/css">
  <link href="css/material.css" rel="stylesheet">
  <link href="css/modal.css" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('header_title')
  Nom_matiere
@endsection

@section('js')
 <script src="js/matiere.js"></script>
  <!-- Compiled and minified JavaScript -->
@endsection

@section('content')
<div class="container">
    <div class="info-matiere">
        <div class="row">
            <div class="col col-md-3 col-xs-6">
                nombre de sous matiere
            </div>
            <div class="col col-md-2 col-xs-6">
                14
            </div>
            <div class="col col-md-3 col-md-offset-2 col-xs-6">
                nombre d'eleves
            </div>
            <div class="col col-md-2 col-xs-6">
                42
            </div>
        </div>
    </div>
  <div id="parametrages" class="modal">
    <div class="modal-content">
        <div class="modal-header">
         <div id="nav-icon1" class="open">
          <span></span>
          <span></span>
         </div>
         <h4>Confirmation</h4>
        </div>
        <div class="modal-body">
        <form class="pure-form pure-form-stacked" action="" method="POST">{!! csrf_field() !!}
         <label for="intitule">Nom de sous matiere</label>
         <input id="intitule" name="intitule" type="text" placeholder="cc1" autofocus autocomplete="false">

         <label for="pourcentage">pourcentage</label>
         <input id="pourcentage" type="number" min="0" max="100" name="pourcent">

         <div class="inline">
          <button type="submit" class="confirm pure-button pure-button-primary" onclick="event.preventDefault(),edit()">Confirmer</button>
          <button type="submit" class="annuler pure-button pure-button-primary" onclick="event.preventDefault(),clodeModal(this)">Annuler</button>
         </div>
        </form>
        </div>
    </div>
 </div>
    <div class="table-matiere">
        {!! csrf_field() !!}
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Apogée</th>
                    <th><a href="#" onclick="parametrage(this)">sous Matiere1</a></th>
                    <th><a href="#" onclick="parametrage(this)">sous Matiere2</a></th>
                    <th><a href="#" onclick="parametrage(this)">sous Matiere3</a></th>
                    <th><a href="#" onclick="parametrage(this)">...</a></th>
                    <th>Moyenne matiere</th>
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