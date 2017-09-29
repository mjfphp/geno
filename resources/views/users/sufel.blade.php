@extends('layouts.tab')


@section('header')
  Gestion des Eleves du Niveau {{ $niveau->abbreviation }}
@endsection

@section('css-child')
    <link rel="stylesheet" href="{{ URL::asset('css/export/export.css') }}">
@endsection

@section('js-child')
  <script  src="{{ URL::asset('js/sufel.js') }}"></script>
  <script src="{{ URL::asset('js/import_export/import.js')}}"></script>
  <script src="{{ URL::asset('js/import_export/export.js') }}"></script>
@endsection

@section('buttons1')
    <button class="btnstyle" type="button" id="addel" name="addel">Ajouter Un Eleve</button>
    <button type="button" id ="import_btn" class="btnstyle"> Importer</button>
    <button type="submit" id ="exprtE" name="exprtE" form="doEstop" class="btnstyle">Exporter Excel</button>
    <button type="button" id ="exprtP" name="exprtP" form="doPdf" class="btnstyle">Exporter Pdf</button>
@endsection

@section('fil_tab')
                  <h4 class="h4">Détails des éléves :</h4>
                        <table class="table" id="table1" data-id="{{$niveau->id}}">
                            <thead>
                                <tr>
                                    <th class="text-center">Appogé</th>
                                    <th class="text-center">CNE</th>
                                    <th class="text-center">CIN</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prénom</th>
                                    <th class="text-center">statut</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Group</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Lieu </th>
                                    <th class="text-center">Ville</th>
                                    <th class="text-center">Tél</th>
                                    <th class="text-center">Choix</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($niveau->eleves)
                            @foreach($niveau->eleves as $item)
                                <tr class="item{{$item->id}}">
                                    <td>{{$item->apoge}}</td>
                                    <td>{{$item->cne}}</td>
                                    <td>{{$item->cin}}</td>
                                    <td>{{$item->nom}}</td>
                                    <td>{{$item->prenom}}</td>
                                    <td>{{$item->statut}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->grp}}</td>
                                    <td>{{$item->date_naissance}}</td>
                                    <td>{{$item->lieu_naissance}}</td>
                                    <td>{{$item->ville}}</td>
                                    <td>{{$item->num}}</td>
                                    <td>
                                      <button class="edit-modal edit btn" data-id={{$item->id}} data-info="/eleves/">
                                          <span class="glyphicon glyphicon-edit"></span> Edit
                                      </button>
                                      <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/eleves/">
                                          <span class="glyphicon glyphicon-trash"></span> Delete
                                      </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                         </table>
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

                             {{csrf_field()}}

                             <input type="hidden" name="_method" value="put" class="method">

                             <label for="apoge">Apogé</label>
                             <input id="apoge" type="text" name="apoge" placeholder="Apogé">

                             <label for="cne">CNE</label>
                             <input id="cne" type="text" name="cne" placeholder="CNE">

                             <label for="cin">CIN</label>
                             <input id="cin" type="text" name="cin" placeholder="CIN">

                             <label for="nom">Nom</label>
                            <input id="nom" name="nom" type="text" placeholder="Nom" >

                             <label for="prenom">Prenom</label>
                             <input id="prenom" type="text" name="prenom" placeholder="Prenom" >

                             <label for="statut">Statue</label>
                              <select id="statut" name="statut" value="{{ old('statut') }}">
                                    <option value="Aj">Aj</option>
                                    <option value="Tr">Tr</option>
                                   <option value="Bd">Bd</option>
                              </select>

                             <label for="grp">Groupe</label>
                             <select id="grp" name="grp" value="{{ old('grp') }}">
                                      @for($i=1;$i<$niveau->nbg+1;$i++)
                                               <option value="{{$i}}">{{$i}}</option>
                                      @endfor
                             </select>
                             <label for="email">Email</label>
                             <input id="email" type="text" name="email" placeholder="Email" >

                             <label for="date_naissance">Date De Naissance</label>
                             <input id="date_naissance" type="date" name="date_naissance" placeholder="Date De Naissance" >

                             <label for="lieu_naissance">Lieu De Naissance</label>
                             <input id="lieu_naissance" type="text" name="lieu_naissance" placeholder="Lieu De Naissance">

                             <label for="ville">Ville</label>
                             <input id="ville" type="text" name="ville" placeholder="Ville" >

                             <label for="num">Tél</label>
                             <input id="num" type="number" name="num" placeholder="Tél" >

                         <div class="inline">
                           <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                           <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                         </div>
                       </form>
                         </div>
                        </div>
                </div>
                    @include('partial.deleteS')
                     <div id="import" class="modal">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <div id="nav-icon1" class="open" onclick="cancel_import()">
                                      <span></span>
                                      <span></span>
                                  </div>
                                  <h4>Importer liste des élèves</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="pure-form pure-form-stacked" method="post" id="up" enctype="multipart/form-data">
                                      {{csrf_field()}}
                                      <input id='fileid' type='file' name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="resetUp()">
                                      <div id="up_result"></div>
                                      <div class="inline">
                                          <button type="button" class="pure-button pure-button-primary" onclick="up('/eleves/up')">valider</button>
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
                            <label for="CNE" class="inline">
                                <input id='CNE' type='checkbox' name="CNE" form="doP">CNE</label>
                        </div>
                        <div class="checkbox">
                            <label for="EMAIL" class="inline">
                                <input id='EMAIL' type='checkbox' name="EMAIL" form="doP">EMAIL</label>
                        </div>
                        <div class="checkbox">
                            <label for="CIN" class="inline">
                                <input id='CIN' type='checkbox' name="CIN" form="doP">CIN</label>
                        </div>
                        <div class="checkbox">
                            <label for="Date_naissance" class="inline">
                                <input id='Date_naissance' type='checkbox' name="Date_naissance" form="doP">Date naissance
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="lieu_naisasnce" class="inline">
                                <input id='lieu_naisasnce' type='checkbox' name="lieu_naisasnce" form="doP">Lieu naissance
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Statut" class="inline">
                                <input id='Statut' type='checkbox' name="Statut" form="doP">Statut
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
                            <label for="Groupe" class="inline">
                                <input id='Groupe' type='checkbox' name="Groupe" form="doP">Groupe
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
                            <label for="ECIN" class="inline">
                                <input id='ECIN' type='checkbox' name="ECIN" form="doE">Cin</label>
                        </div>
                        <div class="checkbox">
                            <label for="EEMAIL" class="inline">
                                <input id='EEMAIL' type='checkbox' name="EEMAIL" form="doE">Email</label>
                        </div>
                        <div class="checkbox">
                            <label for="EAPOGEE" class="inline">
                                <input id='EAPOGEE' type='checkbox' name="EAPOGEE" form="doE">Apogée</label>
                        </div>
                        <div class="checkbox">
                            <label for="EDate_naissance" class="inline">
                                <input id='EDate_naissance' type='checkbox' name="EDate_naissance" form="doE">Date naissance
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="Elieu_naisasnce" class="inline">
                                <input id='Elieu_naisasnce' type='checkbox' name="Elieu_naisasnce" form="doE">Lieu naissance
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="EStatut" class="inline">
                                <input id='EStatut' type='checkbox' name="EStatut" form="doE">Statut
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
                            <label for="EGroupe" class="inline">
                                <input id='EGroupe' type='checkbox' name="EGroupe" form="doE">Groupe
                            </label>
                        </div>
                        <div class="checkbox">
                            <label for="ENiveau" class="inline">
                                <input id='ENiveau' type='checkbox' name="ENiveau" form="doE">Niveau
                            </label>
                        </div>
                        <div class="inline">
                            <button type="submit" class="pure-button pure-button-primary" form="doE">valider</button>
                            <button type="button" id="cancel_export_Excel" class="pure-button pure-button-primary">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
    <form class="hidden" method="post" action="/eleves/doE" id="doE">
        {{csrf_field()}}
        <input type="hidden" value="{{$id}}" name="niv" form="doE">
    </form>
    <form class="hidden" method="post" action="/eleves/doP" id="doP">
        {{csrf_field()}}
        <input type="hidden" value="{{$id}}" name="niv" form="doP">
    </form>

         @endsection
