<html>
    <head>
        <title>Liste des Etudiants</title>
        <link rel="stylesheet" href="css/export/pdf.css">
    </head>
<body>
<div class="tab">
    <table class="table" id="table">
        <thead>
            <tr>
                <th class="text-center">APOGEE</th>
                <th class="text-center">CNE</th>
                <th class="text-center">NOM</th>
                <th class="text-center">PRENOM</th>
                <th class="text-center">EMAIL</th>
                
                @if($cases->CIN=="on")
                <th class="text-center">CIN</th>
                @endif
                @if($cases->Date_naissance=="on")
                <th class="text-center">DATE NAISSANCE</th>
                @endif

                @if($cases->lieu_naisasnce=="on")
                <th class="text-center">LIEU NAISSANCE</th>
                @endif
                
                @if($cases->Statut=="on")
                <th class="text-center">STATUT</th>
                @endif

                @if($cases->Tel=="on")
                <th class="text-center">TEL</th>
                @endif
                
                @if($cases->Groupe=="on")
                <th class="text-center">GROUPE</th>
                @endif

                @if($cases->Niveau=="on")
                <th class="text-center">NIVEAU</th>
                @endif
                
            </tr>
        </thead>
        <tbody>
        @foreach($eleves as $item)
            <tr class="item{{$item->id}}">
                <td>{{$item->apoge}}</td>
                <td>{{$item->cne}}</td>
                <td>{{$item->nom}}</td>
                <td>{{$item->prenom}}</td>
                <td>{{$item->email}}</td>
                
                @if($cases->CIN=="on")
                <td class="text-center">{{$item->cin}}</td>
                @endif
                @if($cases->Date_naissance=="on")
                <td class="text-center">{{$item->date_naissance}}</td>
                @endif

                @if($cases->lieu_naisasnce=="on")
                <td class="text-center">{{$item->lieu_naissance}}</td>
                @endif
                
                @if($cases->Statut=="on")
                <td class="text-center">{{$item->statut}}</td>
                @endif

                @if($cases->Tel=="on")
                <td class="text-center">{{$item->num}}</td>
                @endif
                
                @if($cases->Groupe=="on")
                <td class="text-center">{{$item->grp}}</td>
                @endif

                @if($cases->Niveau=="on")
                <td class="text-center">{{$item->niveau_id}}</td>
                @endif

            </tr>
        @endforeach
        </tbody>
     </table>
    </div>
</body>
</html>