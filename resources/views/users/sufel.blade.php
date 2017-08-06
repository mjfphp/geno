@extends('layouts.tab')

@section('header')
  Gestion des Eleves
@endsection

@section('js-child')
  <script src="js/sufel.js"></script>
@endsection

          @section('buttons1')
            <button class="btnstyle" type="button" id="addel" name="addel">Ajouter Un Eleve</button>
            <div id="addeleve" class="modal">
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

                                <label for="apoge">Apogé</label>
                                <input id="apoge" type="text" name="apoge" placeholder="Apogé">

                                <label for="cin">CNE</label>
                                <input id="cin" type="text" name="cne" placeholder="CNE">

                                <label for="cin">CIN</label>
                                <input id="cin" type="text" name="cin" placeholder="CIN">

                                <label for="nom">Nom</label>
                               <input id="nom" name="nom" type="text" placeholder="Nom" value="{{ old('nom') }}">

                                <label for="prenom">Prenom</label>
                                <input id="prenom" type="text" name="prenom" placeholder="Prenom" value="{{ old('prenom') }}">

                                <label for="email">Email</label>
                                <input id="email" type="text" name="email" placeholder="Email" value="{{ old('email') }}">

                                <label for="date_naissance">Date De Naissance</label>
                                <input id="date_naissance" type="date" name="date_naissance" placeholder="Date De Naissance" value="{{ old('date_naissance') }}">

                                <label for="lieu_naissance">Lieu De Naissance</label>
                                <input id="lieu_naissance" type="text" name="lieu_naissance" placeholder="Lieu De Naissance" value="{{ old('lieu_naissance') }}">

                                <label for="ville">Ville</label>
                                <input id="ville" type="text" name="ville" placeholder="Ville" value="{{ old('ville') }}">

                                <label for="num">Tél</label>
                                <input id="num" type="number" name="num" placeholder="Tél" value="{{ old('num') }}">
                                <div class="inline">
                                  <button type="submit" class="confirm pure-button pure-button-primary">Confirmer</button>
                                  <button type="button" class="annuler pure-button pure-button-primary">Annuler</button>
                                </div>
                          </form>
                       </div>
                      </div>
                  </div>
          @endsection


                @section('fil_tab')
                  <h4 class="h4">Détails des éléves :</h4>
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th class="hidden text-center">Id</th>
                                    <th class="text-center">Appogé</th>
                                    <th class="text-center">CNE</th>
                                    <th class="text-center">CIN</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Prénom</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Lieu </th>
                                    <th class="text-center">Ville</th>
                                    <th class="text-center">Tél</th>
                                    <th class="text-center">statue</th>
                                    <th class="text-center">Choix</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($eleve as $item)
                                <tr class="item{{$item->id}}">
                                    <td class="hidden">{{$item->id}}</td>
                                    <td>{{$item->apoge}}</td>
                                    <td>{{$item->cne}}</td>
                                    <td>{{$item->cin}}</td>
                                    <td>{{$item->nom}}</td>
                                    <td>{{$item->prenom}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->date_naissance}}</td>
                                    <td>{{$item->lieu_naissance}}</td>
                                    <td>{{$item->ville}}</td>
                                    <td>{{$item->num}}</td>
                                    <td></td>
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
                            </tbody>
                         </table>
                  <div id="editEl" class="modal">
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

                             <label for="apoge">Apogé</label>
                             <input id="apoge" type="text" name="apoge" placeholder="Apogé">

                             <label for="CNE">CNE</label>
                             <input id="CNE" type="text" name="cne" placeholder="CNE">

                             <label for="cin">CIN</label>
                             <input id="cin" type="text" name="cin" placeholder="CIN">

                             <label for="nom">Nom</label>
                            <input id="nom" name="nom" type="text" placeholder="Nom" >

                             <label for="prenom">Prenom</label>
                             <input id="prenom" type="text" name="prenom" placeholder="Prenom" >

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
                    <div id="deleteEl" class="modal">
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
