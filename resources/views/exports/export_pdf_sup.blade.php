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
                
                @if($cases->Email=="on")
                <th class="text-center">EMAIL</th>
                @endif
                @if($cases->Ref=="on")
                <th class="text-center">REF PROF</th>
                @endif
                @if($cases->Grade=="on")
                <th class="text-center">GRADE</th>
                @endif

                @if($cases->Spe=="on")
                <th class="text-center">SPECIALITE</th>
                @endif
                
                @if($cases->Addr=="on")
                <th class="text-center">ADRESSE</th>
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
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->prenom}}</td>
                
                @if($cases->Email=="on")
                <td>{{$item->email}}</td>
                @endif

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