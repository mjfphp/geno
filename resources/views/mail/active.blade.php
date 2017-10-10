<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon"  href="{{ asset('/images/ensa.png') }}"/>
       <title> ENSA </title>
    <link  href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link  href="{{ asset('css/bootstrap-select.min.css') }}"   rel="stylesheet">
    <link  href="{{ asset('css/bootstrap.min.css') }}"   rel="stylesheet">
    <style media="screen">
    body {
      min-width: auto !important;
    }
      .cnt {
        display: block;
        width: 100%;
      }
      .wrap{
        display: flex;
        height: 500px;
        justify-content: center;
        align-items: center;
        flex-direction: column;
      }

    </style>
  </head>


  <body>
    <div class="header">
        <a href="{{Route('index')}}">
          <img src="{{ URL::asset('images/ensa.png') }}">
        </a>
        <h1>Coordonnées du compte</h1>
    </div>

    <div class="cnt">
      <div class="wrap">
        <h1>Votre cordonnées</h1>
        <p> Email : najih.driss@gmail.com</p>
        <p> Password : azdoiaôaz8</p>
      </div>
    </div>

       <!-- Parent -->
    <script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}" ></script>
    <script src="{{ URL::asset('js/bootstrap-select.min.js') }}"  ></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  </body>
</html>
