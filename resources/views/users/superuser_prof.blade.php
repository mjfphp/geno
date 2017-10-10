  @extends('layouts.app')

@section('style')
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
                <table class="table" id="table">
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
                 <div id="editS" class="modal" style="display:@if ($errors->any()) block @endif">
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
                          <form class="pure-form pure-form-stacked" method="post">

                          <div class="form-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put" class="method">

                            <div class="form-group">
                              <label class="control-label col-md-4" for="refprof">refprof</label>
                              <div class="col-md-8 @if($errors->has('refprof')) has-error @endif">
                                <input class="form-control" id="refprof" type="text" placeholder="id" name="refprof" required/>
                                @if($errors->has('ref'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('refprof') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="name">Nom</label>
                              <div class="col-md-8 @if($errors->has('name')) has-error @endif">
                                <input class="form-control" id="name" type="text" placeholder="nom" name="name" required/>
                                @if($errors->has('name'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('name') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="prenom">Prenom</label>
                              <div class="col-md-8 @if($errors->has('prenom')) has-error @endif">
                                <input class="form-control" id="prenom" type="text" placeholder="prenom" name="prenom" required/>
                                @if($errors->has('prenom'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('prenom') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="grade">Grade</label>
                              <div class="col-md-8 @if($errors->has('grade')) has-error @endif">
                                <input class="form-control" id="grade" type="text" placeholder="Grade" name="grade" required/>
                                @if($errors->has('grade'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('grade') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="specialite">Specialite</label>
                              <div class="col-md-8">
                                <select class="form-control" id="specialite" name="specialite">
                                  @foreach ($spes as $key=>$spe)
                                    <option value="{{$spe}}">{{$spe}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="email">Email</label>
                              <div class="col-md-8 @if($errors->has('email')) has-error @endif">
                                <input class="form-control" id="email" type="email" placeholder="email" name="email" required/>
                                @if($errors->has('email'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('email') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="adress">Adresse</label>
                              <div class="col-md-8 @if($errors->has('adress')) has-error @endif">
                                <input class="form-control" id="adress" type="text" placeholder="adresse" name="adress" required/>
                                @if($errors->has('adress'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('adress') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="ville">Ville</label>
                              <div class="col-md-8 @if($errors->has('ville')) has-error @endif">
                                <input class="form-control" id="ville" type="text" placeholder="ville" name="ville" required/>
                                @if($errors->has('ville'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('ville') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="num">Tel</label>
                              <div class="col-md-8 @if($errors->has('num')) has-error @endif">
                                <input class="form-control" id="num" type="number" placeholder="Tél" name="num" min="0" required/>
                                @if($errors->has('num'))
                                <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('num') }}</div>
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-4" for="departement_id">Département</label>
                              <div class="col-md-8">
                                <select class="form-control" id="departement_id" name="departement_id">
                                  @foreach ($depts as $dept)
                                    <option value="{{$dept->id}}">{{$dept->intitule}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="inline">
                            <button type="submit" class="confirm confirm2 btn btn-primary">Confirmer</button>

                            <button type="button" class="annuler annuler2 btn btn-danger">Annuler</button>

                          </div>

                        </form>
                        </div>
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