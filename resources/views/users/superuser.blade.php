@extends('layouts.app')

@section('style')
  <link  href="{{ asset('css/superuser.css') }}" rel="stylesheet" type="text/css">
  <link  href="{{ asset('css/trash.css') }}" rel="stylesheet" type="text/css">
  <link  href="{{ asset('css/modal.css') }}" rel="stylesheet" type="text/css">
  <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
@endsection

@section('header_title')
  Welcome Superuser
@endsection

@section('content')
  <div id="editT" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
             <div id="nav-icon1" class="open">
             <span></span>
             <span></span>
             </div>
                <h4></h4>
           </div>
         <div class="modal-body">
           <form class="form-horizontal" method="post">
             <div class="form-body">
               {{ csrf_field()}}
               <input type="hidden" name="_method" value="put" class="method2">
               <div class="stud">
                 <table class="table" id="table">
                     <thead>
                         <tr>
                             <th class="text-center">Apoge</th>
                             <th class="text-center">Cin</th>
                             <th class="text-center">Nom</th>
                             <th class="text-center">Prenom</th>
                             <th class="text-center">Group</th>
                             <th class="text-center">Choix</th>
                         </tr>
                     </thead>
                     <tbody>
                     @foreach($stud as $item)
                         <tr>
                             <td>{{$item->apoge}}</td>
                             <td>{{$item->cin}}</td>
                             <td>{{$item->nom}}</td>
                             <td>{{$item->prenom}}</td>
                             <td>{{$item->grp}}</td>
                             <td>
                               <button class="edit-modal reuse btn" data-id="{{$item->id}}" data-info="/filieres/">
                                   <span class="glyphicon glyphicons-restart"></span> Restaurer
                               </button>
                               <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/filieres/">
                                   <span class="glyphicon glyphicon-trash"></span> Supprimer
                               </button>
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                  </table>
                </div>
                  <div class="prof">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Ref</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center">Prenom</th>
                                <th class="text-center">Choix</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($profs as $item)
                            <tr>
                                <td>{{$item->refprof}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->prenom}}</td>
                                <td>
                                  <button class="edit-modal reuse btn" data-id="{{$item->id}}" data-info="/filieres/">
                                      <span class="glyphicon glyphicons-restart"></span> Restaurer
                                  </button>
                                  <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/filieres/">
                                      <span class="glyphicon glyphicon-trash"></span> Supprimer
                                  </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                     </table>
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
    <div class="cont">
      <div class="parent2">
        <div class="test1"><i class="fa fa-user fa-2x"></i></div>
        <div class="test2"><i class="fa fa-graduation-cap fa-2x"></i></div>
        <div class="mask2"><i class="fa fa-trash-o"></i></div>
      </div>
        <div class="searchBar">
          {{Form::open(['class' => 'form-inline','action' => 'Adminlog@home', 'method' => 'post']) }}


            <div class="form-group  @if($errors->has('search')) has-error @endif" >
              <input type="search" class="form-control" name="search" placeholder="Search" value="{{old('search')}}">
            </div>

            <div class="form-group">
              <select class="form-control" name="filter" value="{{old('filter')}}">
                  <option value="0" selected>Filiere-Niveaux</option>
                  <option value="1">Niveau-Modules</option>
                  <option value="2">Niveau-eleves</option>
                  <option value="3">Modules-Matieres</option>
                  <option value="4">Prof</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" name="button" class="btn btn-primary ">Search</button>
            </div>
            @if($errors->has('search'))
                    <div class="error" style="color:red">{{ $errors->first('search') }}</div>
            @endif
             @if(session('rep'))
                                  <div class="alert alert-danger" role="alert">
                                        <strong>{{session('rep')}}</strong>
                                  </div>
                      @endif
          {{ Form::close() }}
        </div>

        <div class="l">
          <ul class="list">
            <li class="element">
              <a href="/profs">
                  <img src="images/prof.png">
              </a>
            </li>
            <li class="element">
              <a href="/filieres">
                <img src="images/filiere.png">
              </a>
            </li>
          </ul>
        </div>
    </div>
@stop
