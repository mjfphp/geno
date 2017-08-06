@extends('layouts.tab')

@section('header')
  Gestion des Modules du {{$niveau->abbreviation}}
@endsection

@section('js-child')
  <script    src="{{ URL::asset('js/sufmodule.js') }}"></script>
@endsection

          @section('buttons1')
            <button class="btnstyle" type="button" id="addmod" name="addmod">Ajouter Un module</button>
            <div id="addmodule" class="modal">
                  <div class="modal-content">
                     <div class="modal-header">
                       <div id="nav-icon1" class="open">
                       <span></span>
                       <span></span>
                       </div>
                          <h4>Confirmation</h4>
                     </div>
                     <div class="modal-body">
                       {{Form::open(['class' => 'pure-form pure-form-stacked','action' => 'AmodulesC@store', 'method' => 'post']) }}

                                {{csrf_field()}}

                                <!-- Hahoma les old a noob-->
                                <label for="intitule">Intitule</label>
                                <input id="intitule" type="text" name="intitule" value="{{ old('intitule') }}" placeholder="intitule">

                                <label for="abbreviation">Abréviation</label>
                                <input id="abbreviation" name="abbreviation" type="text" value="{{ old('abbreviation') }}" placeholder="Abréviation">

                                <label for="user_id">Responsable</label>
                                <select id="user_id" name="user_id">
                                  @foreach ($profs as $prof)
                                           <option value="{{$prof->id}}">{{$prof->name.' '.$prof->prenom}}</option>
                                  @endforeach
                                </select>

                                <input id="niveau_id" type="hidden" value="{{$niveau->id}}" name="niveau_id">

                                <label for="departement_id">Département</label>
                                <select id="departement_id" name="departement_id" value="{{ old('departement') }}">
                                      @foreach ($depts as $dept)
                                            <option value="{{$dept->id}}">{{$dept->intitule}}</option>
                                       @endforeach
                                </select>

                                <label for="semestre">semestre</label>
                                <select id="semestre" name="semestre" value="{{ old('semestre') }}">
                                   <option value="S1">S1</option>
                                   <option value="S2">S2</option>
                                </select>

                                <label for="nature">Nature</label>
                                <input id="nature" type="text" name="nature" value="{{ old('nature') }}" placeholder="Nature">

                                <label for="vh">Vh</label>
                                <input id="vh" type="number" name="vh" placeholder="Vh" value="{{ old('vh') }}" min="0" step="0.0001">

                                <div class="inline">
                                  <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                                  <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                                </div>
                          {{ Form::close() }}
                       </div>
                      </div>
                  </div>
          @endsection


                @section('fil_tab')
                  <h4 class="h4">Détails du Module :</h4>
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th class="hidden text-center">Id</th>
                                    <th class="text-center">Intitule</th>
                                    <th class="text-center">Abréviation</th>
                                    <th class="text-center">Résponsable</th>
                                    <th class="text-center">Niveau</th>
                                    <th class="text-center">Département</th>
                                    <th class="text-center">Semestre</th>
                                    <th class="text-center">Nature</th>
                                    <th class="text-center">Vh</th>
                                    <th class="text-center">Choix</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($niveau->modules)
                            @foreach($niveau->modules as $item)
                                <tr class="item{{$item->id}}">
                                    <td class="hidden">{{$item->id}}</td>
                                    <td>{{$item->intitule}}</td>
                                    <td>{{$item->abbreviation}}</td>
                                    <td>
                                      @if($item->coordinateur)
                                           {{$item->coordinateur->name." ".$item->coordinateur->prenom}}
                                       @else
                                          {{$item->user_id}}
                                       @endif
                                    </td>
                                    <td>{{$niveau->abbreviation}}</td>
                                     <td>
                                     @if($item->departement)
                                         {{$item->departement->intitule}}
                                      @else
                                     {{$item->departement_id}}
                                    @endif
                                    </td>
                                    <td>{{$item->semestre}}</td>
                                    <td>{{$item->nature}}</td>
                                    <td>{{$item->vh}}</td>
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
                            @endif
                            </tbody>
                         </table>
                  <div id="editMod" class="modal">
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

                             <input type="hidden" name="_method" value="put">

                             <label for="intitule">Intitule</label>
                             <input id="intitule" type="text" name="intitule" placeholder="intitule">

                             <label for="abbreviation">Abréviation</label>
                             <input id="abbreviation" name="abbreviation" type="text" placeholder="Abréviation">

                             <label for="user_id">Responsable</label>
                             <select id="user_id" name="user_id">
                                @foreach ($profs as $prof)
                                    <option value="{{$prof->id}}">{{$prof->name.' '.$prof->prenom}}</option>
                                @endforeach
                             </select>

                             {{ Form::text('niveau_id',$niveau->id, array('id' => ('niveau_id') ) ) }}

                             <label for="departement_id">Département</label>
                             <select id="departement_id" name="departement_id">
                                @foreach ($depts as $dept)
                                            <option value="{{$dept->id}}">{{$dept->intitule}}</option>
                                @endforeach
                             </select>

                             <label for="semestre">semestre</label>
                             <select id="semestre" name="semestre">
                               <option value="S1">S1</option>
                               <option value="S2">S2</option>

                             </select>

                             <label for="nature">Nature</label>
                             <input id="nature" type="text" placeholder="Nature" name="nature">

                             <label for="vh">Vh</label>
                             <input id="vh" type="number" placeholder="Vh" min="0" step="0.0001" name="vh">

                         <div class="inline">
                           <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                           <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                         </div>
                     </form>
                           </div>
                           </div>

                    </div>
                    <div id="deleteMod" class="modal">
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

                               <input type="hidden" name="_method" value="delete">

                               <h4>Vous Voulez vraimenet supprimer cette module ?</h4>
                           <div class="inline">
                             <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                             <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                           </div>
                          </form>
                             </div>
                             </div>

                      </div>
                @endsection
