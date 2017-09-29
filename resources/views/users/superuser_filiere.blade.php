@extends('layouts.tab')

@section('header')
  Gestion des filières
@endsection

@section('js-child')
  <script src="js/suf.js"></script>
@endsection

@section('buttons1')
    <button class="btnstyle" type="button" id="addf" name="addf" data-info="/filieres/">Ajouter Une filière</button>
    <button class="btnstyle" type="button" id ="addd" name="addd" data-info="/dept/">Ajouter Un département</button>
    <button class="btnstyle" type="button" class="hidden" id ="imprt" name="imprt">Importer</button>
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
    <div id="editF" class="modal">
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
                <input type="hidden" name="_method" value="put" class="method1">

                <label for="intitule">Intitule</label>
                <input id="intitule" type="text" placeholder="intitule" name="intitule" value="{{ old('intitule') }}">

                <label for="abbreviation">Abréviation</label>
                <input id="abbreviation" type="text" placeholder="Abréviation" name="abbreviation" value="{{ old('intitule') }}">

                <label for="user_id">Responsable</label>
                <select id="user_id" name="user_id" value="{{ old('user_id') }}">
                   @foreach ($profs as $prof)
                        <option value="{{$prof->id}}">{{$prof->name.' '.$prof->prenom}}</option>
                   @endforeach
                </select>


                <div class="inline">
                  <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                  <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                </div>
              </form>
             </div>
             </div>

      </div>
        @include('partial.deleteS')
        <div id="editD" class="modal">
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
                   <input type="hidden" name="_method" value="put" class="method2">

               <label for="intitule">Intitule</label>
               <input id="intitule" type="text" placeholder="Intitule" name="intitule">

               <label for="user_id">Responsable</label>
               <select id="user_id" name="user_id">
                  @foreach ($profs as $prof)
                       <option value="{{$prof->id}}">{{$prof->name.' '.$prof->prenom}}</option>
                 @endforeach
               </select>
               <div class="inline">
                 <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                 <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
               </div>
             </form>
                 </div>
                 </div>

          </div>
@endsection
