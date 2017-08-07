@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
  <link rel="stylesheet"  href="{{ asset('css/tabmodalbuttons.css') }}">
@endsection

@section('header_title')
  Gestion des Niveaux
@endsection

@section('js')
  <script type="text/javascript" src="{{ URL::asset('js/tab.js') }}"></script>
  <script   src="{{ URL::asset('js/supn.js') }}"></script>
@endsection

@section('content')


  <div class="wrapper">
    <div class="left-side">
      <ul class="tree">
             <li>
                <input type="checkbox" checked="checked" id="c1" />
                <a href="#" class="tree_label" for="c1">FILiERES</a>
                  <ul>
                  @if($filieres)
                     @foreach($filieres as $fil)
                      <li><span><a href="{{ Route('filieres.show', $fil->id ) }}">{{$fil->abbreviation}}</a></span></li>
                     @endforeach
                  @endif
                      <li><span><a href="{{ Route('filieres.index')}}">RETOUR</a></span></li>
                  </ul>
            </li>
       </ul>
     </div>

     <div class="tables">
       <div class="t">
         <div class="buttons1">
            <button class="btnstyle" type="button" id="addniv" name="addniv">Ajouter Un Niveau</button>
            <div id="addniveau" class="modal">
                  <div class="modal-content">
                     <div class="modal-header">
                       <div id="nav-icon1" class="open">
                       <span></span>
                       <span></span>
                       </div>
                          <h4>Confirmation</h4>
                     </div>
                     <div class="modal-body">
                    {{Form::open(['class' => 'pure-form pure-form-stacked','action' => 'AniveauxC@store', 'method' => 'post']) }}
                                <label for="abbreviation">Abréviation</label>
                                <input id="abbreviation" type="text" name="abbreviation" placeholder="intitule">

                                <label for="nbg">Nombre de Groupe</label>
                                <input id="nbg" type="number" name="nbg" placeholder="Nombre de Groupe" min="00">

                                <!-- Hna dir code php li kayjib id o i7ato f blasst id -->
                                <input id="filiere_id" class="hidden" name="filiere_id" value="{{$filiere->id}}">

                                <div class="inline">
                                  <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                                  <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                                </div>
                          {{ Form::close() }}
                       </div>
                      </div>
                  </div>
                </div>

                <div class="fil_tab">
                  <h4 class="h4">Détails des Niveaux :</h4>
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th class=" text-center">Id</th>
                                    <th class="text-center">Abréviation</th>
                                    <th class="text-center">Nombre de groupe</th>
                                    <th class="text-center">Filiere</th>
                                    <th class="text-center">Choix</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($filiere->niveaux)
                                @foreach($filiere->niveaux as $item)
                                  <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->abbreviation}}</td>
                                    <td>{{$item->nbg}}</td>
                                    <td>
                                        {{ $filiere->abbreviation }}

                                    </td>
                                    <td>
                                      <button class="edit-modal edit btn">
                                          <span class="glyphicon glyphicon-edit"></span> Edit
                                      </button>
                                      <button class="delete-modal delete btn">
                                          <span class="glyphicon glyphicon-trash"></span> Delete
                                      </button>
                                    </td>
                                  </tr>
                                @endforeach
                            @endif
                            </tbody>
                         </table>
                  <div id="editNiv" class="modal">
                        <div class="modal-content">
                           <div class="modal-header">
                             <div id="nav-icon1" class="open">
                             <span></span>
                             <span></span>
                             </div>
                                <h4>Confirmation</h4>
                           </div>
                         <div class="modal-body">
                           <form class="pure-form pure-form-stacked" method="post">

                             {{ csrf_field()}}
                             <input type="hidden" name="_method" value="put">

                             <label for="abbreviation">Abréviation</label>
                             <input id="abbreviation" type="text" name="abbreviation" placeholder="intitule">

                             <label for="nbg">Nombre de Groupe</label>
                             <input id="nbg" type="number" name="nbg" placeholder="Nombre de Groupe" min="00">

                             <!-- Hna dir code php li kayjib id o i7ato f blasst id -->
                             <input id="filiere_id" name="filiere_id" value="{{$filiere->id}}" class="hidden">

                         <div class="inline">
                           <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                           <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                         </div>
                       </form>
                           </div>
                           </div>

                    </div>
                    <div id="deleteNiv" class="modal">
                          <div class="modal-content">
                             <div class="modal-header">
                               <div id="nav-icon1" class="open">
                               <span></span>
                               <span></span>
                               </div>
                                  <h4>Confirmation</h4>
                             </div>
                           <div class="modal-body">
                             <form class="pure-form pure-form-stacked" method="post">
                               {{ csrf_field()}}
                               <input name="_method" type="hidden" value="DELETE">
                               <h4>Vous Voulez vraiment supprimer ce Niveau ?</h4>
                           <div class="inline">
                             <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                             <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                           </div>
                         </form>
                             </div>
                             </div>

                      </div>
                </div>
              </div>
              </div>
              </div>
