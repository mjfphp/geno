@extends('layouts.tab')
@section('header')
  Gestion des matières du {{ $module->abbreviation }}
@endsection

@section('js-child')
  <script  src="{{ URL::asset('js/sufmatiere.js') }}"></script>
@endsection


        @section('buttons1')
          <div class="buttons1">
            <button class="btnstyle" type="button" id="addmt" data-info="/matieres/">Ajouter Une matière</button>
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
        @endsection

        @section('fil_tab')
          <h4 class="h4">Détails de la Matiere :</h4>
                <table class="table" id="table" data-id="{{$module->id}}">
                    <thead>
                        <tr>
                            <th class="text-center">Intitule</th>
                            <th class="text-center">groupe</th>
                            <th class="text-center">Prof</th>
                            <th class="text-center">Module</th>
                            <th class="text-center">Pourcentage</th>
                            <th class="text-center">Vh</th>
                            <th class="text-center">Choix</th>
                        </tr>
                    </thead>
                    <tbody>
                                       @if($module->matieres)
                                             @foreach($module->matieres as $item)
                                                 <tr class="item{{$item->id}}">
                                                     <td>{{$item->intitule}}</td>
                                                     <td>{{$item->grp}}</td>
                                                      <td>
                                                            @if($item->prof)
                                                                {{$item->prof->name." ".$item->prof->prenom}}
                                                             @else
                                                              {{$item->user_id}}
                                                            @endif
                                                     </td>
                                                     <td>
                                                     {{$module->abbreviation}}</td>
                                                     <td>{{$item->pourcentage}}</td>
                                                     <td>{{$item->vh}}</td>
                                                     <td>
                                                       <button class="edit-modal edit btn" data-id="{{$item->id}}">
                                                           <span class="glyphicon glyphicon-edit"></span> Edit
                                                       </button>
                                                       <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/matieres/">
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
                  <form class="pure-form pure-form-stacked" method="post">
                    <div class="form-body">
                   {{ csrf_field()}}
                   <input type="hidden" name="_method" value="put" class="method">

                   <div class="form-group">
                     <label class="control-label col-md-5" for="intitule">Intitule</label>
                     <div class="col-md-7 @if($errors->has('intitule')) has-error @endif">
                       <input class="form-control" id="intitule" type="text" name="intitule" placeholder="Intitule">
                       @if($errors->has('intitule'))
                       <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('intitule') }}</div>
                       @endif
                     </div>
                   </div>
                   <div class="form-group">
                     <label class="control-label col-md-5" for="grp">Groupe</label>
                     <div class="col-md-7">
                       <select class="form-control" id="grp" name="grp" value="{{ old('grp') }}" type="number">
                          @for($i=1;$i<$module->niveau->nbg+1;$i++)
                                   <option value="{{$i}}">{{$i}}</option>
                          @endfor
                      </select>
                     </div>
                   </div>
                   <div class="form-group">
                      <label class="control-label col-md-5" for="user_id">Prof</label>
                      <div class="col-md-7">
                        <select class="form-control" id="user_id" name="user_id">
                          @foreach ($profs as $prof)
                             <option value="{{$prof->id}}">{{$prof->name." ".$prof->prenom}}</option>
                          @endforeach
                        </select>
                      </div>
                   </div>

                 <div class="form-group">
                   <label class="control-label col-md-5" for="pourcentage">pourcentage</label>
                   <div class="col-md-7 @if($errors->has('pourcentage')) has-error @endif">
                     <input class="form-control" id="pourcentage" type="number" name="pourcentage" min="0" step="0.01" max="1">
                     @if($errors->has('pourcentage'))
                     <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('pourcentage') }}</div>
                     @endif
                   </div>
                 </div>

                 <div class="form-group">
                   <label class="control-label col-md-5" for="vh">Vh</label>
                   <div class="col-md-7 @if($errors->has('vh')) has-error @endif">
                     <input class="form-control" id="vh" type="number" name="vh" placeholder="Vh" min="0" step="0.001">
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
