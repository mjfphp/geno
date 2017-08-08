<?php

namespace App\Http\Controllers;

use App\Notifications\ActiverCompte;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Eleve;
use App\Niveau;
use Validator;
use \Storage;
use Maatwebsite\Excel\Writers\CellWriter;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class IEleves extends Controller
{

    public function Users()
    {
        $profs=User::all();
        return $profs;
    }
    
    public function Departements(){
        $depts = Departement::all();
        return $depts;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
     public function upload(Request $request)
    {
        $val_rules=[
            'nom' => 'required|alpha',
            'prenom'=>'required|alpha',
            'cin'=>'required|unique:eleves',
            'cne'=>'required|unique:eleves',
            'apoge'=>'required|unique:eleves',
            'email' => 'required|unique:eleves|email',
            'ville'=>'max:30|nullable|alpha',
            'lieu_naissance'=>'max:30|nullable|alpha',
            'date_naissance'=>'required|',
            'statut'=>'required',
            'num'=>'numeric|min:10|nullable',
            'grp'=>'required'
        ];

        $arr= [
            "message"=>null,
            "class"=>null
        ];

        $file_messages=[
            'required'=>"Aucun fichier en chargement!",
            'mimes'=>'Le fichier doit être de format: :values!',
            'uploaded'=>"Le fichier n'a pas pu être chargé!",
            'size'=>'La taille du fichier dépasse 10Mb'
        ];
    
        $file_rules=array(
            'file' =>'required|file|max:10000|mimes:xls,xlsx'
        );
        $file = $request->file('file');
        $file_validator = Validator::make($request->all(),$file_rules,$file_messages);
            if ($file_validator->fails()) {
                $arr=[
                    "message"=>$file_validator->errors()->first('file'),
                    "style"=>"text-danger"
                ];
                return response()->json($arr);
            }
        if($request->hasFile("file")){
            $file = $request->file('file');
            $path=$file->getRealPath();
            $name=$file->getClientOriginalName();
            $destination="upload/".$name;
            $upload=Storage::put($destination,file_get_contents($path));
            if($upload){
                $reader=Excel::load($path);
                $results = $reader->get();
                $lignes=$reader->toArray();
                foreach($lignes as $i=>$ligne)
                {
                    $l=$i+1; //in case of errors show the ligne where the error is
                    $users_validator=Validator::make($ligne,$val_rules);
                    if($users_validator->fails()){
                        $arr=[
                            "message"=>"ligne $l:\r\n".$users_validator->errors()->first(),
                            "style"=>"text-danger"
                        ];
                        return response()->json($arr);
                    }
        $eleve = new Eleve;
        $eleve->nom  = $ligne['nom'];
        $eleve->prenom=$ligne ['prenom'];
        $eleve->email  = $ligne['email'];
        $eleve->apoge = $ligne['apoge'];
        $eleve->cne = $ligne['cne'];
        $eleve->cin = $ligne['cin'];
        $eleve->lieu_naissance=$ligne['lieu_naissance'];
        $eleve->date_naissance=$ligne['date_naissance'];
        $eleve->ville = $ligne['ville'];
        $eleve->statut =$ligne['statut'];
        $eleve->niveau_id=1;
//        $eleve->niveau_id=$ligne['niveau_id'];
        $eleve->num =$ligne['num'];
        $eleve->grp=$ligne['grp'];
        $eleve->save();
                }
            }
        }else{
            $arr["message"]="Aucun fichier choisi!";
            $arr["class"]="text-danger";
        }
         $arr["message"]="$i lignes ajoutées!";
         $arr["class"]="success";
         return response()->json($arr);
    }
}
