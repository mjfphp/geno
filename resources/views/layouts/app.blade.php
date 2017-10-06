<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon"  href="{{ asset('/images/ensa.png') }}"/>
       <title>@section('title') ENSA @show</title>
    <link    href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link  href="{{ asset('css/bootstrap-select.min.css') }}"   rel="stylesheet">
    <link  href="{{ asset('css/bootstrap.min.css') }}"   rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    @yield('style')
  </head>


  <body>
    <div class="header">
        <a href="{{Route('index')}}"><img src="{{ URL::asset('images/ensa.png') }}"></a>
        <h1>@yield('header_title')</h1>
        <div class="logoutCnt">
     @if( Session::has('admin'))
     <a href="{{Route('Alogout')}}"> <button class="logout"  name="button">Logout</button> </a>
     @endif
        </div>
    </div>

      @yield('content')

       <!-- Parent -->
    <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}" ></script>
    <script src="{{ URL::asset('js/bootstrap-select.min.js') }}"  ></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    @yield('js')
    <script type="text/javascript">
    $(document).ready(function() {
      $('.table').DataTable();
    } );
    </script>
    <script src="{{ URL::asset('js/global.js') }}"></script>
  </body>
</html>
