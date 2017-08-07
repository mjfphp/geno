@extends('layouts.app')

@section('style')
  <link  href="{{ asset('css/superuser.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header_title')
  Welcome Superuser
@endsection

@section('content')
    <div class="cont">
        <div class="searchBar">
          <div class="container">
             <div class="row">
                <div class="col-md-12">
                   <div class="input-group" id="adv-search">
                      <input type="text" class="form-control" placeholder="Search" />
                      <div class="input-group-btn">
                        <div class="btn-group" role="group">
                          <div class="dropdown dropdown-lg">
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <form class="form-horizontal" role="form">
                                      <div class="form-group">
                                        <label for="filter">Filter</label>
                                        <select class="form-control">
                                            <option value="0" selected>All Snippets</option>
                                            <option value="1">Featured</option>
                                            <option value="2">Most popular</option>
                                            <option value="3">Top rated</option>
                                            <option value="4">Most commented</option>
                                        </select>
                                      </div>
                                      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                  </form>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
