    @extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
  <link href="css/sup.css" rel="stylesheet" type="text/css">
  <link href="css/modal.css" rel="stylesheet" type="text/css">
  <link href="css/export/export.css" rel="stylesheet" type="text/css">
@endsection

@section('header_title')
  Gestion des professeurs
@endsection
      <?php $i=0; ?>
@section('js')
  <script src="js/sup.js"></script>
  <script src="js/import_export/import.js"></script>
  <script src="js/import_export/export.js"></script>
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
          <button type="button" id="addp" name="addp" class="btnstyle" data-info="/profs/">Ajouter Un Prof</button>
          <button type="button" id ="import_btn" class="btnstyle"> Importer</button>
          <button type="submit" id ="exprtE" name="exprtE" class="btnstyle">Exporter Excel</button>
          <button type="button" id ="exprtP" name="exprtP" form="doPdf" class="btnstyle">Exporter Pdf</button>

        </div>
        <div class="tab">
          <h4>Liste des profs :</h4>
          <div class="container ">
          <div class="table-responsive text-center">
                <table class="table table-bordered table-striped display" id="table">
                    <thead>
                        <tr>
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
                              <button class="edit-modal btn" data-id="{{$item->id}}" data-info="/profs/">
                                  <span class="glyphicon glyphicon-edit"></span> Edit
                              </button>
                              <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/profs/">
                                  <span class="glyphicon glyphicon-trash"></span> Delete
                              </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                 </table>
               </div>
             </div>
                 @include('partial.deleteS')
                   <div id="editS" class="modal">
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
                          <input type="hidden" name="_method" value="put" class="method">

                          <label for="refprof">refprof</label>
                          <input id="refprof" type="text" placeholder="id" name="refprof" required/>

                          <label for="name">Nom</label>
                          <input id="name" type="text" placeholder="nom" name="name" required/>

                          <label for="prenom">Prenom</label>
                          <input id="prenom" type="text" placeholder="prenom" name="prenom" required/>

                          <label for="grade">Grade</label>
                          <input id="grade" type="text" placeholder="Grade" name="grade" required/>

                          <label for="specialite">Specialite</label>
                          <select id="specialite" name="specialite">
                            @foreach ($spes as $key=>$spe)
                              <option value="{{$spe}}">{{$spe}}</option>
                            @endforeach
                          </select>

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
        <div id="import" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="nav-icon1" class="open" onclick="cancel_import()">
                        <span></span>
                        <span></span>
                    </div>
                    <h4>Importer liste des profs</h4>
                </div>
                <div class="modal-body">
                    <form class="pure-form pure-form-stacked" method="post" id="up" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input id='fileid' type='file' name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="resetUp()">
                        <div id="up_result"></div>
                        <div class="inline">
                            <button type="button" class="pure-button pure-button-primary" onclick="up('/profs/up')">valider</button>
                            <button type="button" id="cancel_upload" class="cancel_upload pure-button pure-button-primary">Annuler</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>

        <div id="export_pdf" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="nav-icon1" class="open" onclick="cancel_export()">
                        <span></span>
                        <span></span>
                    </div>
                    <h4>Les champs à exporter</h4>
                </div>
                <div class="modal-body">
                    <form class="form-group" method="post" id="up" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="checkbox">
                            <label for="all" class="inline">
                                <input id='all' type='checkbox' name="all" form="doP" onchange="check('pdf')">Check all</label>
                        </div>
                        <div class="checkbox">
                            <label for="Email" class="inline">
                                <input id='Email' type='checkbox' name="Email" form="doP">Email
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Ref" class="inline">
                                <input id='Ref' type='checkbox' name="Ref" form="doP">Ref prof
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Grade" class="inline">
                                <input id='Grade' type='checkbox' name="Grade" form="doP">Grade
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Spe" class="inline">
                                <input id='Spe' type='checkbox' name="Spe" form="doP">Spécialité
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Addr" class="inline">
                                <input id='Addr' type='checkbox' name="Addr" form="doP">Adresse
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Ville" class="inline">
                                <input id='Ville' type='checkbox' name="Ville" form="doP">Ville
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Tel" class="inline">
                                <input id='Tel' type='checkbox' name="Tel" form="doP">Téléphone
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Dep" class="inline">
                                <input id='Dep' type='checkbox' name="Dep" form="doP">Département
                            </label>
                        </div>
                        <div class="inline">
                            <button type="submit" class="pure-button pure-button-primary" form="doP">valider</button>
                            <button type="button" id="cancel_export" class="pure-button pure-button-primary">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="export_excel" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="nav-icon1" class="open" onclick="cancel_export()">
                        <span></span>
                        <span></span>
                    </div>
                    <h4>Les champs à exporter</h4>
                </div>
                <div class="modal-body">
                    <form class="form-group" method="post" id="do">
                        {{csrf_field()}}
                        <div class="checkbox">
                            <label for="Eall" class="inline">
                                <input id='Eall' type='checkbox' name="all" form="doP" onchange="check('excel')">Check all</label>
                        </div>
                        <div class="checkbox">
                            <label for="Eemail" class="inline">
                                <input id='Eemail' type='checkbox' name="Eemail" form="doE">Email
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="ERef" class="inline">
                                <input id='ERef' type='checkbox' name="ERef" form="doE">Ref prof
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="EGrade" class="inline">
                                <input id='EGrade' type='checkbox' name="EGrade" form="doE">Grade
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="ESpe" class="inline">
                                <input id='ESpe' type='checkbox' name="ESpe" form="doE">Spécialité
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="EAddr" class="inline">
                                <input id='EAddr' type='checkbox' name="EAddr" form="doE">Adresse
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="EVille" class="inline">
                                <input id='EVille' type='checkbox' name="EVille" form="doE">Ville
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="ETel" class="inline">
                                <input id='ETel' type='checkbox' name="ETel" form="doE">Téléphone
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="EDep" class="inline">
                                <input id='EDep' type='checkbox' name="EDep" form="doE">Département
                            </label>
                        </div>
                        <div class="inline">
                            <button type="submit" class="pure-button pure-button-primary" form="doE">valider</button>
                            <button type="button" id="cancel_export_Excel" class="pure-button pure-button-primary">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <form class="hidden" method="post" action="profs/doE" id="doE">
        {{csrf_field()}}
    </form>
    <form class="hidden" method="post" action="profs/doP" id="doP">
        {{csrf_field()}}
    </form>
@stop
