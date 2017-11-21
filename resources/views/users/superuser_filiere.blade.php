@extends('layouts.tab')

@section('header')
  Gestion des filières
@endsection

@section('js-child')
  <script src="js/suf.js"></script>
@endsection

@section('buttons1')
    <button class="btnstyle" type="button" id="addf" name="addf" data-info="/filieres/">Ajouter Une filière</button>
    <button class="btnstyle" type="button" id="addd" name="addd" data-info="/dept/">Ajouter Un département</button>
    <button class="btnstyle" type="button" class="hidden" id="imprt" name="imprt">Importer</button>
@endsection

@section('fil_tab')
    <h4 class="h4">Liste des filières :</h4>
          <table class="table" id="table">
              <thead>
                  <tr>
                      <th class="text-center">Intitule</th>
                      <th class="text-center">Abreviation</th>
                      <th class="text-center">Résponsable</th>
                      <th class="text-center">Choix</th>
                  </tr>
              </thead>
              <tbody>
              @foreach($fil as $item)
                  <tr class="item{{$item->id}}">
                      <td>{{$item->intitule}}</td>
                      <td>{{$item->abbreviation}}</td>
                      <td>
                      @if($item->prof)
                        {{$item->prof->name.' '.$item->prof->prenom}}
                      @else
                         {{ "NULL"}}
                      @endif
                      </td>
                      <td>
                        <button class="edit-modal edit btn" data-id="{{$item->id}}" data-info="/filieres/">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/filieres/">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                        <button class="info-modal info1 btn" data-id="{{$item->id}}" data-info="/filieres/">
                            <span class="glyphicon glyphicon-info-sign"></span> Niveaux
                        </button>
                      </td>
                  </tr>
              @endforeach
              </tbody>
           </table>
           <h4 class="h4">Liste des départements :</h4>
                 <table class="table" id="table1">
                     <thead>
                         <tr>

                             <th class="text-center">Intitule</th>
                             <th class="text-center">Résponsable</th>
                             <th class="text-center">Choix</th>
                         </tr>
                     </thead>
                     <tbody>
                     @foreach($depts as $item)
                         <tr class="item{{$item->id}}">
                             <td>{{$item->intitule}}</td>

                             <td>
                               @if($item->chefD)
                                    {{ $item->chefD->name." ".$item->chefD->prenom}}
                                @else
                                  {{ "NULL"}}
                                @endif
                             </td>
                             <td>
                               <button class="edit-modal edit2 btn" data-id="{{$item->id}}" data-info="/dept/">
                                   <span class="glyphicon glyphicon-edit"></span> Edit
                               </button>
                               <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/dept/">
                                   <span class="glyphicon glyphicon-trash"></span> Delete
                               </button>
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                  </table>
    <div id="editF" class="modal" style="display:@if ($errors->any()) block @endif">
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
                <div class="form-body">
                  {{csrf_field()}}
                  <input type="hidden" name="_method" value="put" class="method1">

                  <div class="form-group">
                    <label class="control-label col-md-4" for="intitule">Intitule</label>
                    <div class="col-md-7 @if($errors->has('intitule')) has-error @endif">
                      <input class="form-control" id="intitule" type="text" placeholder="intitule" name="intitule" value="{{ old('intitule') }}">
                      @if($errors->has('intitule'))
                      <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('intitule') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4" for="abbreviation">Abréviation</label>
                    <div class="col-md-7 @if($errors->has('abbreviation')) has-error @endif">
                      <input class="form-control" id="abbreviation" type="text" placeholder="Abréviation" name="abbreviation" value="{{ old('bbreviation') }}">
                      @if($errors->has('bbreviation'))
                        <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('bbreviation') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-4" for="user_id">Responsable</label>
                    <div class="col-md-7">
                    <select class="form-control" id="user_id" name="user_id" value="{{ old('user_id') }}">
                       @foreach ($profs as $prof)
                            <option value="{{$prof->id}}">{{$prof->name.' '.$prof->prenom}}</option>
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
        @include('partial.deleteS')
        <div id="editD" class="modal">
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
                   <div class="form-body">
                     {{ csrf_field()}}
                     <input type="hidden" name="_method" value="put" class="method2">

                 <div class="form-group">
                   <label class="control-label col-md-4" for="intitule">Intitule</label>
                   <div class="col-md-7 @if($errors->has('intitule')) has-error @endif">
                     <input class="form-control" id="intitule" type="text" placeholder="Intitule" name="intitule">
                     @if($errors->has('intitule'))
                     <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('intitule') }}</div>
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
@endsection
