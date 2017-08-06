@extends('layouts.app')


@section('title')
    404
@stop

@section('header_title')
    Page Not Found
@stop

@section('content')
  <div class="page_content_wrap">
     <div class="content_wrap">
          <div class="text-align-center error-404">
            <h1 class="huge">404</h1>
            <hr class="sm">
            <p><strong>Sorry - Page Not Found!</strong></p>
            <p>The page you are looking for was moved, removed, renamed<br>or might never existed. You stumbled upon a broken link :(</p>
          </div>
      </div>
  </div>
@stop