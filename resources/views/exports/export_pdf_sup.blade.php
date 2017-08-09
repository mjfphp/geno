<html>
    <head>
        <title>Liste des profs</title>
        <link rel="stylesheet" href="css/export/pdf.css">
    </head>
<body>
    <div class="header">
        <img src="images/ensa.png">
        <h1>Liste des profs</h1>
    </div>
    <div class="tab">
     <table class="table " id="table">
        <thead class="active">
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
                <td>{{$item->departement["intitule"]}}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
     </table>
    </div>
</body>
</html>