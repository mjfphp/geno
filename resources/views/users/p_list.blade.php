<html>
    <head>
        <title>Liste des profs</title>
        <style>
            body{
              margin: 5px 0px 0px 5px;
            }
            .table{
              box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.24);
              z-index: -1;
              text-align: center;
              width: 50%;
              margin: 0px auto;
              float: none;
            }

            .table thead td{
              background-color: #337ab7;
              padding: 10px;
              color: white;
              margin-left: 5px;
              width: 100%;
            }

            tbody tr:nth-child(odd){
              background-color: #f2e5e5;
            }

            .table tr{
              font-family: "Rubik",sans-serif;
            }
        </style>
    </head>
<body>
    <div class="tab">
     <table class="table" id="table">
        <thead>
            <tr>
                <th class="text-center">Nom</th>
                <th class="text-center">Prenom</th>
                <th class="text-center">Email</th>
                
                @if($cases->Ref=="on")
                <th class="text-center">Ref prof</th>
                @endif
                @if($cases->Grade=="on")
                <th class="text-center">Grade</th>
                @endif

                @if($cases->Spe=="on")
                <th class="text-center">Spécialité</th>
                @endif
                
                @if($cases->Addr=="on")
                <th class="text-center">Adresse</th>
                @endif

                @if($cases->Tel=="on")
                <th class="text-center">Tél</th>
                @endif
                
                @if($cases->Ville=="on")
                <th class="text-center">Ville</th>
                @endif

                @if($cases->Dep=="on")
                <th class="text-center">Departement</th>
                @endif

            </tr>
        </thead>
        <tbody>
        @foreach($profs as $item)
            <tr class="item{{$item->id}}">
                <td>{{$item->name}}</td>
                <td>{{$item->prenom}}</td>
                <td>{{$item->email}}</td>
                
                @if($cases->Ref=="on")
                <td>{{$item->refprof}}</td>
                @endif
                
                @if($cases->Grade=="on")
                <td>{{$item->grade}}</td>
                @endif
                
                @if($cases->Spe=="on")
                <td>{{$item->specialite}}</td>
                @endif
                
                @if($cases->Addr=="on")
                <td>{{$item->adress}}</td>
                @endif

                @if($cases->Tel=="on")
                <td>{{$item->num}}</td>
                @endif
                
                @if($cases->Ville=="on")
                <td>{{$item->ville}}</td>
                @endif

                @if($cases->Dep=="on")
                <td>{{$item->departement_id}}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
     </table>
    </div>
</body>
</html>