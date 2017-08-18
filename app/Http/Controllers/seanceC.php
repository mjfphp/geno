<?php

namespace App\Http\Controllers;

use App\Module;
use App\Niveau;
use App\matiere;
use App\Seance;
use App\Absence;
use App\Eleve;
use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers;
use Illuminate\Support\Facades\Session;

class seanceC extends Controller
{
    public $id=5;
    
    public function index(request $request){//id de la matiere dont on veut afficher la liste des etudiants
        $matiere=null;
        $seance=null;
        $eleves=null;
        $AllMatieres=null;
        $seance=Seance::where('id_prof',$this->id)->get();
        $AllMatieres=matiere::where('user_id',$this->id)->get();
        if($request->all()){
            $id=key($request->all());
            $Tempseance=Seance::find($id);
            $matiere=$Tempseance->matieres;
            $id_seance=$Tempseance["id"];
            $eleves=Absence::where('id_seance',$id_seance)->get();
        }        
        return view("users.seances")
            ->with('matiere',$matiere)
            ->with('matieres',$AllMatieres)
            ->with('seances',$seance)
            ->with('eleves',$eleves);
    }
    
    public function add(request $request){

//        $Rules=["matiere"=>"required|unique:seances"];
        $niveaux=Niveau::all();
//        dd($request->all());

        $Rules=["matiere"=>"required"];
        $msg=["unique"=>"La matiere existe déjà!"];
        $validator=Validator::make($request->all(),$Rules);
        if($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $seance=new Seance;
        $seance->id_prof=$this->id;
        $seance->id_matiere=$request->matiere;
        //seance->save();
        
        /**
        On cherche les eleves qui etudient la matiere dont l'id est $request->matiere,
            on les ajoute a la table absence avec la valeur null pour la colonne statut
        
        */
        
        return redirect()->back();
    }
    
    public function show($id){
        return absence::find($id);
    }
    
    public function set(request $request){
        $rules=[
            "0"=>"nullable|max:100",
            "2"=>"required"
        ];
        $msg=[
            'max'=>'Le commentaire ne peut pas depasser 100 caractères',
            'required'=>'L\'élève est présent ou absent!',
            'boolean'=>'la valeur doit être vrai ou faux'
             ];
        $newvals=array_chunk($request->all(),3);
        foreach($newvals as $val){
            $validator=Validator::make($val,$rules,$msg);
            if($validator->fails()){
                dd($validator->errors()->all());
                return redirect()
                    ->back()
                    ->withErrors($validator);
            }else{
                if($val[2]==1 || $val[2]==0){
                    $eleve=$this->show($val[1]);
                    $eleve->statut=$val[2];
                //    $eleve->comment=$val[0];  la colonne comment n'existe pas encore
                    $eleve->save();
                }
            }
            
        }
        return redirect()->back();
    }
}