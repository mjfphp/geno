<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departement;
use App\Filiere;
use App\Niveau;
use App\User;
use Validator;


class AfilieresC extends Controller
{

    public function index()
    {
        $fil =Filiere::all();
        $profs=User::all();
        $depts = Departement::all();
        //$dep = $fil->department;
        return view("users.superuser_filiere")
            ->with('depts',$depts)
            ->with('fil',$fil)
            ->with('profs',$profs);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'intitule' => 'required|unique:filieres',
            'user_id'=>'nullable',
            'abbreviation'=>'required|min:1|max:7'


        ]);



        if ($validator->fails()) {
            return redirect('/filieres')
                ->withErrors($validator)
                ->withInput();
        }
        $filiere = new Filiere;
        $filiere->intitule   = $request->input('intitule');
        $filiere->abbreviation=$request->input('abbreviation');
        $filiere->user_id  = $request->input('user_id');
        $filiere->save();

        return redirect('/filieres');
    }


    public function show($id)
    {
         if($filiere =Filiere::find($id))
         {
             $filieres=Filiere::all();
             return view("users.sup_niv")
                 ->with('filiere',$filiere)
                 ->with('filieres',$filieres);
         }
            else
                return redirect('/filieres');
    }





    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'intitule' => 'required|unique:filieres,intitule,'.$id,
            'abbreviation'=>'required|min:1|max:7|unique:filieres,abbreviation,'.$id,
            'user_id'=>'nullable'

        ]);



        if ($validator->fails()) {
            return redirect('/filieres')
                ->withErrors($validator)
                ->withInput();
        }
        $filiere =Filiere::find($id);
        $filiere->intitule=$request->input('intitule');
        $filiere->abbreviation=$request->input('abbreviation');
        $filiere->user_id=$request->input('user_id');
        $filiere->save();

        return redirect('/filieres');
    }


    public function destroy($id)
    {
        $filiere = Filiere::find($id);
        if($filiere)
        {
            $niveaux=Niveau::where('filiere_id',$id)->get();
            foreach($niveaux as $niveau)
                $niveau->delete();
        }
        $filiere->delete();
        return redirect('/filieres');


    }


}
