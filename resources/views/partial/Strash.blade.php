@extends('layouts.trash')

@section('style')
<link href="css/sup.css" rel="stylesheet" type="text/css">
<link href="css/modal.css" rel="stylesheet" type="text/css">
@endsection

@section('header_title')
BackUp Etudiants
@endsection
@section('content')
  <div class="cont">
      <div class="buttons1">


      </div>
      <div class="tab">
        <h4>Liste des Etudiants :</h4>
        <div class="container ">
        <div class="table-responsive text-center">
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
                        <button class="edit-modal restaurer btn" data-id="{{$item->id}}" data-info="/trashs/">
                            <span class="glyphicon glyphicon-refresh"></span> Restaurer
                        </button>
                        <button class="delete-modal delete btn" data-id="{{$item->id}}" data-info="/trashs/">
                            <span class="glyphicon glyphicon-trash"></span> Supprimer
                        </button>
                      </td>
                  </tr>
              @endforeach
              </tbody>
           </table>
             </div>
           </div>
           @include('partial.deleteS')
       </div>

  </div>
@stop
