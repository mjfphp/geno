@extends('layouts.app')

@section('title')
  Gestion absence 
@endsection

@section('header_title')
  Gestion d'absence de la matière {{$matiere["intitule"]}}
@endsection

@section('style')
<link rel="stylesheet"  href="{{ asset('css/buttons.css') }}">
<link rel="stylesheet"  href="{{ asset('css/modal.css') }}">
<link rel="stylesheet"  href="{{ asset('css/absence.css') }}">
@endsection

@section('js')
  <script    src="{{ URL::asset('js/Seances/seances.js') }}"></script>
@endsection

@section('content')
<div class="container" style="padding-top:100px">
    <div class="buttons1">
            <button class="btnstyle" type="button" id="addS" >Ajouter Une séance</button>
            <button class="btnstyle" type="button" id="showS" >Afficher une séance</button>
            @if(count($eleves))
            <button class="btnstyle" type="submit" id="Validate" form="set_abs">Valider</button>
            @endif
        @if ($errors->any())
        <div class="alert-danger col-lg-7">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @if(count($eleves))
    <table class="table table-bordered" id="absences">
        <thead>
            <tr>
                <th>Apogée</th>
                <th>Nom complet</th>
                <th>Absences</th>
                <th>Commentaire</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
        @foreach($eleves as $eleve)
            <tr>
             <td>{{$eleve->eleve["apoge"]}}</td>
             <td>{{$eleve->eleve["nom"]}} {{$eleve->eleve["prenom"]}}</td>
             <td>{{App\Absence::where('statut',"=",0)->where('id_eleve','=',$eleve["id"])->count()}}</td>
             <td>
                 <input maxlength="100" type="text" name="comment{{$eleve["id"]}}" form="set_abs">
                 <input type="hidden" name="val{{$eleve["id"]}}" value="{{$eleve["id"]}}" form="set_abs">
                </td>
             <td><label for="P{{$eleve["id"]}}">P</label><input  id="P{{$eleve["id"]}}" type="radio" value="1" name="State{{$eleve["id"]}}" checked="checked" form="set_abs"/>
                <label for="A{{$eleve["id"]}}">A</label><input  id="A{{$eleve["id"]}}" type="radio" value="0" name="State{{$eleve["id"]}}" form="set_abs"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    <form action="/seances/set" method="post" id="set_abs"></form>
    
    <div id="addS" class="modal">
    <div class="modal-content">
     <div class="modal-header">
      <div id="nav-icon1" class="open">
        <span></span>
        <span></span>
      </div>
      <h4>Ajouter séance</h4>
     </div>
     <div class="modal-body">
     <form method="post" action="/seances/add" class="pure-form pure-form-stacked">
            @if($matieres!=null)
        <label for="matiere">Séance</label>
        <select id="matiere" name="matiere" value="{{ old('statut') }}">
            @foreach($matieres as $matiere)
             <option value="{{$matiere['id']}}">{{$matiere['intitule']}}</option>
            @endforeach
        </select>
            @else 
                <b>Aucune matière</b>
            @endif
        <div id="results">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="inline" name="addS">
            <button type="submit" class="confirm pure-button pure-button-primary" >Confirmer</button>
            <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
        </div>
    </form>
    </div>
    </div>
    </div>
    
    <div id="showS" class="modal">
    <div class="modal-content">
     <div class="modal-header">
      <div id="nav-icon1" class="open">
        <span></span>
        <span></span>
      </div>
      <h4>Ajouter séance</h4>
     </div>
     <div class="modal-body">
     <form method="post" action="/seances" class="pure-form pure-form-stacked">
        @if($seances!=null)
        <label>Séances</label>
         <table class="table table-bordered" id="">
        <thead>
            <tr>
                <th>Matière</th>
                <th>Date d'ajout</th>
                <th>Choix</th>
            </tr>
        </thead>
        <tbody>
        @foreach($seances as $seance)
            <tr>
             <td>{{$seance->matiere["intitule"]}}</td>
             <td>{{$seance["created_at"]}}</td>
             <td>
              <button type="submit" name="{{$seance["id"]}}" value="{{$seance["id"]}}" class="pure-button pure-button-primary">Choisir</button>
             </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        @else 
            <b>Aucune matière</b>
        @endif
        <div id="results">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </form>
    </div>
    </div>
    </div>
    
</div>
@endsection
