@extends('layouts.tab')
@section('header')
  Gestion des matières du {{ $module->abbreviation }}
@endsection

@section('js-child')
  <script  src="{{ URL::asset('js/sufmatiere.js') }}"></script>
@endsection


        @section('buttons1')
          <div class="buttons1">
            <button class="btnstyle" type="button" id="addmt">Ajouter Une matière</button>
            <div id="addmatiere" class="modal">
                  <div class="modal-content">
                     <div class="modal-header">
                       <div id="nav-icon1" class="open">
                       <span></span>
                       <span></span>
                       </div>
                          <h4>Confirmation</h4>
                     </div>
                     <div class="modal-body">
                      {{Form::open(['class' => 'pure-form pure-form-stacked','action' => 'AmatieresC@store', 'method' => 'post']) }}

                           {{ csrf_field()}}
                                <label for="intitule">Intitule</label>
                                <input id="intitulef" type="text" name="intitule" value="{{ old('intitule') }}" placeholder="intitule">

                                <label for="grp">Groupe</label>
                                <select id="grp" name="grp" value="{{ old('grp') }}">
                                           @for($i=1;$i<$module->niveau->nbg+1;$i++)
                                                  <option value="{{$i}}">{{$i}}</option>
                                           @endfor
                                 </select>
                                <label for="user_id">Responsable</label>
                                <select id="user_id" name="user_id">
                                  @if($profs)
                                  @foreach ($profs as $prof)
                                     <option value="{{$prof->id}}">{{$prof->name." ".$prof->prenom}}</option>
                                  @endforeach
                                  @endif
                                </select>
                                <input id="module_id" type="hidden" name="module_id" value="{{$module->id}}">

                                <label for="pourcentage">pourcentage</label>
                                <input id="pourcentage" type="number" name="pourcentage" value="{{ old('pourcentage') }}"  min="0" step="0.01" max="1">

                                <label for="vh">Vh</label>
                                <input id="vh" type="number" name="vh" placeholder="Vh" value="{{ old('vh') }}" min="0" step="0.001">

                                <div class="inline">
                                  <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                                  <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                                </div>
                          {{ Form::close() }}
                       </div>
                      </div>
                  </div>
                </div>
        @endsection

        @section('fil_tab')
          <h4 class="h4">Détails de la Matiere :</h4>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="hidden text-center">Id</th>
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
                                                     <td class="hidden">{{$item->id}}</td>
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
          <div id="editMat" class="modal">
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

                 <label for="intitule">Intitule</label>
                 <input id="intitule" type="text" name="intitule" placeholder="Intitule">

                 <label for="grp">Groupe</label>
                   <select id="grp" name="grp" value="{{ old('grp') }}" type="number">
                      @for($i=1;$i<$module->niveau->nbg+1;$i++)
                               <option value="{{$i}}">{{$i}}</option>
                      @endfor
                  </select>
                 <label for="user_id">Prof</label>
                 <select id="user_id" name="user_id">
                   @foreach ($profs as $prof)
                      <option value="{{$prof->id}}">{{$prof->name." ".$prof->prenom}}</option>
                   @endforeach
                 </select>


                 <input id="module_id" type="hidden" name="module_id" value="{{$module->id}}">

                 <label for="pourcentage">pourcentage</label>
                 <input id="pourcentage" type="number" name="pourcentage" min="0" step="0.01" max="1">

                 <label for="vh">Vh</label>
                 <input id="vh" type="number" name="vh" placeholder="Vh" min="0" step="0.001">

                 <div class="inline">
                   <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                   <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                 </div>
               </form>
                   </div>
                   </div>

            </div>
            <div id="deleteMat" class="modal">
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
                     <input type="hidden" name="_method" value="delete">

                   <h4>Vous voulez vraiment supprimer cette matière ?</h4>

                   <div class="inline">
                     <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                     <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                   </div>
                 </form>
                     </div>
                     </div>

              </div>
        @endsection
