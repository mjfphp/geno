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
  Nom_module
@endsection

@section('js')
 <script src="js/module.js"></script>
  <!-- Compiled and minified JavaScript -->
@endsection

@section('content')
<div id="parametrages" class="modal" style="display:@if ($errors->any()) block @endif">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
         <div id="nav-icon1" class="open">
          <span></span>
          <span></span>
         </div>
         <h4>Confirmation</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" action="" method="POST">

          <div class="form-body">
            {!! csrf_field() !!}

              <div class="form-group">
           <label for="intitule">Nom de matiere</label>
                  <div class="col-md-8 @if($errors->has('intitule')) has-error @endif">
           <input id="intitule" name="intitule" type="text" placeholder="AP11" autocomplete="false">
                  </div>
              </div>

              <div class="form-group">
           <label for="avantRatt">pourcentage avant ratt</label>
                  <div class="col-md-8 @if($errors->has('avantRatt')) has-error @endif">
                  <input id="avantRatt" type="number" min="0" max="100" name="avantRatt">
                  </div>
              </div>

          <div class="form-group">
          <label for="apresRatt">pourcentage après ratt</label>
              <div class="col-md-8 @if($errors->has('apresRatt')) has-error @endif">
              <input id="apresRatt" type="number" min="0" max="100" name="apresRatt">
              </div>
          </div>
          </div>

         <div class="inline">
          <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
          <button type="submit" class="annuler pure-button pure-button-primary" onclick="event.preventDefault(),clodeModal(this)">Annuler</button>
         </div>
        </form>
        </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="info-matiere">
        <div class="row">
            <div class="col col-md-3 col-xs-6">
                nombre de matière
            </div>
            <div class="col col-md-2 col-xs-6">
                8
            </div>
            <div class="col col-md-3 col-md-offset-2 col-xs-6">
                nombre d'élèves
            </div>
            <div class="col col-md-2 col-xs-6">
                62
            </div>
        </div>
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1 small-box valide"></div>
            <div class="col-xs-11 col-sm-5 col-md-5">Validé</div>
            <div class="col-xs-1 col-sm-1 col-md-1 small-box ratt"></div>
            <div class="col-xs-11 col-sm-5 col-md-5">Rattrapage</div>
            <div class="col-xs-1 col-sm-1 col-md-1 small-box nv"></div>
            <div class="col-xs-11 col-sm-5 col-md-5">Non validé</div>
            <div class="col-xs-1 col-sm-1 col-md-1 small-box elim"></div>
            <div class="col-xs-11 col-sm-5 col-md-5">Note éliminatoire</div>
        </div>
    </div>

    <div class="table-matiere">
        {!! csrf_field() !!}
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Apogée</th>
                    <th><a href="#" onclick="parametrage(this)">Matiere 1</a></th>
                    <th colspan="2"><a href="#" onclick="parametrage(this)">Matiere 2</a></th>
                    <th><a href="#" onclick="parametrage(this)">Matiere 3</a></th>
                    <th><a href="#" onclick="parametrage(this)">...</a></th>
                    <th>Moyenne module</th>
                </tr>
            </thead>
            <tbody>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td class="ratt">8</td>
                    <td class="nv">9</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td  class="valide">12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td colspan="2">12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td>12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td colspan="2">12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td class="valide">12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>12.3</td>
                    <td colspan="2">12.3</td>
                    <td>12.3</td>
                    <td>...</td>
                    <td>12.3</td>
                </tr>
                <tr id="id-eleve">
                    <td>1</td>
                    <td id="apogee" value="1315421">1315421</td>
                    <td>1.75</td>
                    <td colspan="2">12.3</td>
                    <td>3.5</td>
                    <td>...</td>
                    <td class="nv">12.3</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<diV id='log'>
</diV>

@stop
