@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
  <link href="css/sup.css" rel="stylesheet" type="text/css">
  <link href="css/modal.css" rel="stylesheet" type="text/css">
@endsection

@section('header_title')
  Gestion des professeurs
@endsection
      <?php $i=0; ?>
@section('js')
  <script src="js/sup.js"></script>
  <!-- Compiled and minified JavaScript -->

@endsection
@section('content')



    <div class="cont">
       @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

        <div class="buttons1">
          <button class="btnstyle" type="button" id="addp" name="addp">Ajouter Un Prof</button>
          <button class="btnstyle" type="button"  id ="imprt" name="imprt">Importer</button>
          <button class="btnstyle" type="button"  id ="exprt" name="imprt">Exporter</button>
          <div id="prof" class="modal">
                <div class="modal-content">
                   <div class="modal-header">
                     <div id="nav-icon1" class="open">
                     <span></span>
                     <span></span>
                     </div>
                        <h4>Confirmation</h4>
                   </div>
                   <div class="modal-body">
                     <div class="pure-form pure-form-stacked">
                           {{Form::open(['action' => 'AprofsC@store', 'method' => 'post']) }}
                                {{csrf_field()}}
                               <label for="name">Nom</label>
                              <input id="name" name="name" type="text" placeholder="Nom" value="{{ old('name') }}">

                              <label for="refprof">Refprof</label>
                              <input id="refprof" name="refprof" type="text" placeholder="Refprof" value="{{ old('refprof') }}">

                              <label for="prenom">Prenom</label>
                              <input id="prenom" type="text" name="prenom" placeholder="Prenom" value="{{ old('prenom') }}">

                              <label for="grade">Grade</label>
                              <input id="grade" type="text" name="grade" placeholder="Grade" value="{{ old('grade') }}">

                              <label for="specialite">Specialite</label>
                              <input id="specialite" type="text" name="specialite" placeholder="Specialite" value="{{ old('specialite') }}">

                              <label for="email">Email</label>
                              <input id="email" type="text" name="email" placeholder="Email" value="{{ old('email') }}">

                              <label for="adress">Adresse</label>
                              <input id="adress" type="text" name="adress" placeholder="Adresse" value="{{ old('adress') }}">

                              <label for="ville">Ville</label>
                              <input id="ville" type="text" name="ville" placeholder="Ville" value="{{ old('ville') }}">

                              <label for="num">Tél</label>
                              <input id="num" type="text" name="num" placeholder="Tél" value="{{ old('num') }}">

                              <label for="departement_id">Département</label>
                              <select id="departement_id" name="departement_id">
                                 @foreach ($depts as $dept)
                                         <option value="{{$dept->id}}">{{$dept->intitule}}</option>
                                 @endforeach
                              </select>



                              <div class="inline">
                                <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                                <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                              </div>
                              {{ Form::close() }}
                        </div>
                     </div>
                    </div>
                </div>
        </div>
        <div class="tab">
          <h4>Liste des profs :</h4>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="hidden text-center">Id</th>
                            <th class="text-center">Ref prof</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Prenom</th>
                            <th class="text-center">Grade</th>
                            <th class="text-center">Spécialité</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Adresse</th>
                            <th class="text-center">Ville</th>
                            <th class="text-center">Tél</th>
                            <th class="text-center">Departement</th>
                            <th class="text-center">Choix</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($profs as $item)
                        <tr class="item{{$item->id}}">
                            <td class="hidden">{{$item->id}}</td>
                            <td>{{$item->refprof}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->prenom}}</td>
                            <td>{{$item->grade}}</td>
                            <td>{{$item->specialite}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->adress}}</td>
                            <td>{{$item->ville}}</td>
                            <td>{{$item->num}}</td>
                            <td>
                               @if($item->departement)
                                        {{ $item->departement->intitule}}
                                    @else
                                      {{ "NULL"}}
                              @endif
                            </td>
                            <td>
                              <button class="edit-modal btn">
                                  <span class="glyphicon glyphicon-edit"></span> Edit
                              </button>
                              <button class="delete-modal btn">
                                  <span class="glyphicon glyphicon-trash"></span> Delete
                              </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                 </table>

                 <div id="deleteModal" class="modal">
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

                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">

                        <h4>Vous Voulez vraiment supprimer ce prof ?</h4>


                        <div class="inline">
                          <button type="submit" class="confirm confirm2 pure-button pure-button-primary">Confirmer</button>

                          <button type="button" class="annuler annuler2 pure-button pure-button-primary">Annuler</button>

                        </div>


                      </form>
                        </div>
                         </div>
                   </div>
                   <div id="editModal" class="modal">
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

                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="put">

                          <label for="refprof">refprof</label>
                          <input id="refprof" type="text" placeholder="id" name="refprof" required/>

                          <label for="name">Nom</label>
                          <input id="name" type="text" placeholder="nom" name="name" required/>

                          <label for="prenom">Prenom</label>
                          <input id="prenom" type="text" placeholder="prenom" name="prenom" required/>

                          <label for="grade">Grade</label>
                          <input id="grade" type="text" placeholder="Grade" name="grade" required/>

                          <label for="specialite">Specialite</label>
                          <input id="specialite" type="text" placeholder="Specialite" name="specialite" required/>

                          <label for="email">Email</label>
                          <input id="email" type="email" placeholder="email" name="email" required/>

                          <label for="adress">Adresse</label>
                          <input id="adress" type="text" placeholder="adresse" name="adress" required/>

                          <label for="ville">Ville</label>
                          <input id="ville" type="text" placeholder="ville" name="ville" required/>

                          <label for="num">Tel</label>
                          <input id="num" type="number" placeholder="Tél" name="num" min="0" required/>

                          <label for="departement_id">Département</label>
                          <select id="departement_id" name="departement_id">
                            @foreach ($depts as $dept)
                              <option value="{{$dept->id}}">{{$dept->intitule}}</option>
                            @endforeach
                          </select>

                          <div class="inline">
                            <button type="submit" class="confirm confirm2 pure-button pure-button-primary">Confirmer</button>

                            <button type="button" class="annuler annuler2 pure-button pure-button-primary">Annuler</button>

                          </div>

                        </form>
                          </div>
                           </div>
                     </div>

         </div>

    </div>

@stop
