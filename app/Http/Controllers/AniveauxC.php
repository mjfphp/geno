<?php

namespace App\Http\Controllers;

use App\Departement;
use App\Eleve;
use App\Module;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Niveau;
use App\User;
use Validator;
class AniveauxC extends Controller
{

    public function index()
    {
        return redirect('/filieres');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filiere_id'=>'required',
            'abbreviation'=>'required|unique:niveaus',
            'nbg' =>'required|max:1'
        ]);



        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $niveau = new Niveau();

        $niveau->abbreviation=$request->input('abbreviation');
        $niveau->nbg=$request->input('nbg');
        $niveau->filiere_id=$request->input('filiere_id');
        $niveau->save();

        return redirect('/filieres/'.$request->input('filiere_id'));
    }


    public function show($id)
    {
        if($niveau=Niveau::find($id))
        {
            $depts=Departement::all();
            $profs=User::all();
            return view("users.sufmodule")
                ->with('profs',$profs)
                ->with('depts',$depts)
                ->with('niveau',$niveau);
        }
        else
            return redirect('/filieres');
    }



    public function update(Request $request, $id)
    {
        $fid=$request->input('filiere_id');
        $validator = Validator::make($request->all(), [
            'filiere_id'=>'required',
            'abbreviation'=>'required|min:1|max:7|unique:niveaus,abbreviation,'.$id,
            'nbg' =>'required|max:1'


        ]);



        if ($validator->fails()) {
            return redirect('/filieres/'.$fid)
                ->withErrors($validator)
                ->withInput();
        }
        $niveau = Niveau::find($id);
        if($niveau)
        {
            $niveau->abbreviation=$request->input('abbreviation');
            $niveau->nbg=$request->input('nbg');
            $niveau->filiere_id=$fid;
            $niveau->save();
        }

        return redirect('/filieres/'.$fid);

    }


    public function destroy($id)
    {
        $niveau = Niveau::find($id);
        if($niveau)
        {
            $modules=Module::where('niveau_id','=','$id');
                foreach ($modules as $module) {
                    $module->delete();
               }
            $eleves=Eleve::where('niveau_id','=','$id');
                foreach ($eleves as $eleve) {
                   $eleve->delete();
                }

            $fid=$niveau->filiere_id;
            $niveau->delete();
        }

        return redirect('/filieres/'.$fid);
    }
}
