@extends('layouts.tab')

@section('header')
  Gestion des Modules du {{$niveau->abbreviation}}
@endsection

@section('js-child')
  <script    src="{{ URL::asset('js/sufmodule.js') }}"></script>
@endsection

          @section('buttons1')
            <button class="btnstyle" type="button" id="addmod" name="addmod" data-info="/modules/">Ajouter Un module</button>
            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
            @endif
          @endsection

                @section('fil_tab')
                  <h4 class="h4">Détails du Module :</h4>
                        <table class="table" id="table1" data-id="{{$niveau->id}}">
                            <thead>
                                <tr>
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
                                      <button class="edit-modal btn" data-id={{$item->id}} data-info="/modules/">
                                          <span class="glyphicon glyphicon-edit"></span> Edit
                                      </button>
                                      <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/modules/">
                                          <span class="glyphicon glyphicon-trash"></span> Delete
                                      </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                         </table>
                  <div id="editS" class="modal">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                             <div class="modal-header">
                               <div id="nav-icon1" class="open">
                               <span></span>
                               <span></span>
                               </div>
                                  <h4>Confirmation</h4>
                             </div>
                           <div class="modal-body">
                        <form class="form-horizontal" method="post">
                               {{csrf_field()}}
                               <input type="hidden" name="_method" value="put" class="method">
                               <div class="form-body">
                                 <div class="form-group">
                                   <label class="control-label col-md-4" for="intitule">Intitule</label>
                                   <div class="col-md-7 @if($errors->has('intitule')) has-error @endif">
                                     <input class="form-control" id="intitule" type="text" name="intitule" placeholder="intitule">
                                     @if($errors->has('intitule'))
                                     <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('intitule') }}</div>
                                     @endif
                                   </div>
                                 </div>

                                 <div class="form-group">
                                   <label class="control-label col-md-4" for="abbreviation">Abréviation</label>
                                   <div class="col-md-7 @if($errors->has('abbreviation')) has-error @endif">
                                     <input class="form-control" id="abbreviation" name="abbreviation" type="text" placeholder="Abréviation">
                                     @if($errors->has('abbreviation'))
                                     <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('abbreviation') }}</div>
                                     @endif
                                   </div>
                                 </div>

                                 <div class="form-group">
                                   <label class="control-label col-md-4" for="user_id">Responsable</label>
                                   <div class="col-md-7">
                                     <select class="form-control" id="user_id" name="user_id">
                                        @foreach ($profs as $prof)
                                            <option value="{{$prof->id}}">{{$prof->name.' '.$prof->prenom}}</option>
                                        @endforeach
                                     </select>
                                   </div>
                                 </div>

                                 <div class="form-group">
                                   <label class="control-label col-md-4" for="departement_id">Département</label>
                                   <div class="col-md-7">
                                     <select class="form-control" id="departement_id" name="departement_id">
                                        @foreach ($depts as $dept)
                                                    <option value="{{$dept->id}}">{{$dept->intitule}}</option>
                                        @endforeach
                                     </select>
                                   </div>
                                 </div>

                                 <div class="form-group">
                                   <label class="control-label col-md-4" for="semestre">semestre</label>
                                   <div class="col-md-7">
                                     <select class="form-control" id="semestre" name="semestre">
                                       <option value="S1">S1</option>
                                       <option value="S2">S2</option>
                                     </select>
                                   </div>
                                 </div>

                                 <div class="form-group">
                                   <label class="control-label col-md-4" for="nature">Nature</label>
                                   <div class="col-md-7 @if($errors->has('nature')) has-error @endif">
                                     <input class="form-control" id="nature" type="text" placeholder="Nature" name="nature">
                                     @if($errors->has('nature'))
                                     <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('nature') }}</div>
                                     @endif
                                   </div>
                                 </div>

                                 <div class="form-group">
                                   <label class="control-label col-md-4" for="vh">Vh</label>
                                   <div class="col-md-7 @if($errors->has('vh')) has-error @endif">
                                     <input class="form-control" id="vh" type="number" placeholder="Vh" min="0" step="0.0001" name="vh">
                                     @if($errors->has('vh'))
                                     <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('vh') }}</div>
                                     @endif
                                   </div>
                                 </div>
                               </div>
                               <div class="inline">
                                 <button type="submit" class="confirm btn btn-primary">Confirmer</button>
                                 <button type="button" class="annuler btn btn-danger">Annuler</button>
                               </div>
                       </form>
                             </div>
                             </div>
                        </div>
                  </div>
                    @include('partial.deleteS')
                @endsection
