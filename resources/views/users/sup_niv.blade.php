@extends('layouts.app')

@section('style')
  <link rel="stylesheet"  href="{{ asset('css/tabmodalbuttons.css') }}">
@endsection

@section('header_title')
  Gestion des Niveaux
@endsection

@section('js')
  <script type="text/javascript" src="{{ URL::asset('js/tab.js') }}"></script>
  <script   src="{{ URL::asset('js/supn.js') }}"></script>
@endsection

@section('content')


  <div class="wrapper" style="display:@if ($errors->any()) block @endif">
    <div class="left-side">
      <ul class="tree">
             <li>
                <input type="checkbox" checked="checked" id="c1" />
                <a href="#" class="tree_label" for="c1">FILiERES</a>
                  <ul>
                  @if($filieres)
                     @foreach($filieres as $fil)
                      <li><span><a href="{{ Route('filieres.show', $fil->id ) }}">{{$fil->abbreviation}}</a></span></li>
                     @endforeach
                  @endif
                      <li><span><a href="{{ Route('filieres.index')}}">RETOUR</a></span></li>
                  </ul>
            </li>
       </ul>
     </div>

     <div class="tables">
       <div class="t">
         <div class="buttons1">
            <button class="btnstyle" type="button" id="addniv" name="addniv" data-info="/niveaux/">Ajouter Un Niveau</button>
                </div>

                <div class="fil_tab">
                  <h4 class="h4">Détails des Niveaux :</h4>
                        <table class="table" id="table" data-id="{{$filiere->id}}">
                            <thead>
                                <tr>
                                    <th class="text-center">Abréviation</th>
                                    <th class="text-center">Nombre de groupe</th>
                                    <th class="text-center">Filiere</th>
                                    <th class="text-center">Choix</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($filiere->niveaux)
                                @foreach($filiere->niveaux as $item)
                                  <tr>
                                    <td>{{$item->abbreviation}}</td>
                                    <td>{{$item->nbg}}</td>
                                    <td>
                                        {{ $filiere->abbreviation }}

                                    </td>
                                    <td>
                                      <button class="edit-modal edit btn" data-id={{$item->id}} data-info="/niveaux/">
                                          <span class="glyphicon glyphicon-edit"></span> Edit
                                      </button>
                                      <button class="delete-modal delete btn" data-id={{$item->id}} data-info="/niveaux/">
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
                             <div class="form-body">
                               {{ csrf_field()}}
                               <input type="hidden" name="_method" value="put" class="method">

                               <div class="form-group">
                                 <label class="control-label col-md-5" for="abbreviation">Abréviation</label>
                                 <div class="col-md-7 @if($errors->has('abbreviation')) has-error @endif">
                                   <input class="form-control" id="abbreviation" type="text" name="abbreviation" placeholder="abbreviation">
                                   @if($errors->has('abbreviation'))
                                   <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('abbreviation') }}</div>
                                   @endif
                                 </div>
                               </div>

                                 <div class="form-group">
                                   <label class="control-label col-md-5" for="nbg">Nombre de Groupe</label>
                                   <div class="col-md-7 @if($errors->has('nbg')) has-error @endif">
                                      <input class="form-control" id="nbg" type="number" name="nbg" placeholder="Nombre de Groupe" min="00">
                                      @if($errors->has('nbg'))
                                      <div class="error" style="color:red"><span class="glyphicon glyphicon-remove"></span> {{ $errors->first('nbg') }}</div>
                                      @endif
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
                </div>
              </div>
              </div>
              </div>
