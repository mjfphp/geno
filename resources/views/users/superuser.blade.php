@extends('layouts.app')

@section('style')
  <link  href="{{ asset('css/superuser.css') }}" rel="stylesheet" type="text/css">
  <link  href="{{ asset('css/trash.css') }}" rel="stylesheet" type="text/css">
  <link  href="{{ asset('css/modal.css') }}" rel="stylesheet" type="text/css">
  <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
@endsection
@section('js')
  <script src="{{ URL::asset('js/links.js') }}"></script>
@endsection
@section('header_title')
  Welcome Superuser
@endsection

@section('content')
    <div class="cont">
      <div class="parent2">
        <div class="Teach"><i class="fa fa-user fa-2x"></i></div>
        <div class="Stud"><i class="fa fa-graduation-cap fa-2x"></i></div>
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
