@extends('layouts.tab')

@section('header')
  Gestion des filières
@endsection

@section('js-child')
  <script src="js/suf.js"></script>
@endsection

@section('buttons1')
    <button class="btnstyle" type="button" id="addf" name="addf">Ajouter Une filière</button>
    <button class="btnstyle" type="button" id ="addd" name="addd">Ajouter Un département</button>
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
    <div id="addfiliere" class="modal">
          <div class="modal-content">
             <div class="modal-header">
               <div id="nav-icon1" class="open">
               <span></span>
               <span></span>
               </div>
                  <h4>Confirmation</h4>
             </div>
             <div class="modal-body">

                 {{Form::open(['class' => 'pure-form pure-form-stacked','action' => 'AfilieresC@store', 'method' => 'post']) }}
                      {{ csrf_field() }}
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
                        {{ Form::close() }}
                  </div>
              </div>
          </div>
          <div id="adddept" class="modal">
                <div class="modal-content">
                   <div class="modal-header">
                     <div id="nav-icon1" class="open">
                     <span></span>
                     <span></span>
                     </div>
                        <h4>Confirmation</h4>
                   </div>
                   <div class="modal-body">

   {{Form::open(['class' => 'pure-form pure-form-stacked','action' =>'test@store','method' => 'post']) }}
                              <label for="intitule">Intitule</label>
                              <input id="intitulef" name="intitule" type="text" placeholder="intitule">

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
                              {{Form::close()}}
                        </div>

                    </div>
                </div>
@endsection

@section('fil_tab')
    <h4 class="h4">Liste des filières :</h4>
          <table class="table" id="table">
              <thead>
                  <tr>
                      <th class="hidden text-center">Id</th>
                      <th class="text-center">Intitule</th>
                      <th class="text-center">Abreviation</th>
                      <th class="text-center">Résponsable</th>
                      <th class="text-center">Choix</th>
                  </tr>
              </thead>
              <tbody>
              @foreach($fil as $item)
                  <tr class="item{{$item->id}}">
                      <td class="hidden">{{$item->id}}</td>
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
                        <button class="edit-modal edit1 btn">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="delete-modal delete1 btn">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                        <button class="info-modal info1 btn">
                            <span class="glyphicon glyphicon-info-sign"></span> Niveaux
                        </button>
                      </td>
                  </tr>
              @endforeach
              </tbody>
           </table>
           <h4 class="h4">Liste des départements :</h4>
                 <table class="table" id="table">
                     <thead>
                         <tr>
                             <th class="hidden text-center">Id</th>
                             <th class="text-center">Intitule</th>
                             <th class="text-center">Résponsable</th>
                             <th class="text-center">Choix</th>
                         </tr>
                     </thead>
                     <tbody>
                     @foreach($depts as $item)
                         <tr class="item{{$item->id}}">
                             <td class="hidden">{{$item->id}}</td>
                             <td>{{$item->intitule}}</td>

                             <td>
                               @if($item->chefD)
                                    {{ $item->chefD->name." ".$item->chefD->prenom}}
                                @else
                                  {{ "NULL"}}
                                @endif
                             </td>
                             <td>
                               <button class="edit-modal edit2 btn">
                                   <span class="glyphicon glyphicon-edit"></span> Edit
                               </button>
                               <button class="delete-modal delete2 btn">
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
                <input type="hidden" name="_method" value="put">

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
      <div id="deleteF" class="modal">
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

                 <input name="_method" type="hidden" value="DELETE">
                 <h4>Vous Voulez vraiment supprimer cette filiere ?</h4>

             <div class="inline">
               <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
               <button  type="button" class="annuler pure-button pure-button-primary">Annuler</button>
             </div>

               </form>

               </div>
               </div>

        </div>
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
                   <input type="hidden" name="_method" value="put">

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
        <div id="deleteD" class="modal">
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
                   <input name="_method" type="hidden" value="DELETE">
                   <h4>Vous Voulez vraiment supprimer ce departement ?</h4>
               <div class="inline">
                 <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                 <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
               </div>
             </form>
                 </div>
                 </div>

          </div>
@endsection
