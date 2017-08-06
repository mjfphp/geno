<?php

namespace App\Http\Controllers;

use App\Matiere;
use Illuminate\Http\Request;
use Validator;

class AmatieresC extends Controller
{

    public function index()
    {
        return redirect('/filieres');
    }



    public function store(Request $request)
    {
        $mid=$request->input('module_id');

        $validator = Validator::make($request->all(), [
            'intitule' => 'required|unique:matieres',
            'pourcentage'=>'nullable',
            'user_id'=>'nullable',
            'vh'=>'numeric|nullable',
            'grp'=>'numeric'
        ]);



        if ($validator->fails()) {
            return redirect('/modules/'.$mid)
                ->withErrors($validator)
                ->withInput();
        }

        $matiere=New Matiere;
        $matiere->intitule=$request->input('intitule');
        $matiere->pourcentage=$request->input('pourcentage');
        $matiere->user_id=$request->input('user_id');
        $matiere->vh=$request->input('vh');
        $matiere->grp=$request->input('grp');
        $matiere->module_id=$mid;

        $matiere->save();
        return redirect('/modules/'.$mid);
    }


    public function update(Request $request, $id)
    {
        $matiere=Matiere::find($id);
        $mid=$matiere->module_id;

        $validator = Validator::make($request->all(), [
            'intitule' => 'required|unique:matieres,intitule,'.$id,
            'pourcentage'=>'nullable',
            'user_id'=>'nullable',
            'vh'=>'numeric|nullable',
            'grp'=>'required|numeric'
        ]);



        if ($validator->fails()) {
            return redirect('/modules/'.$mid)
                ->withErrors($validator)
                ->withInput();
        }

        if($matiere)
        {
            $matiere->intitule=$request->input('intitule');
            $matiere->pourcentage=$request->input('pourcentage');
            $matiere->user_id=$request->input('user_id');
            $matiere->vh=$request->input('vh');
            $matiere->module_id=$mid;

            $matiere->save();
        }

        return redirect('/modules/'.$mid);
    }


    public function destroy($id)
    {
        $matiere=Matiere::find($id);
        $mid=$matiere->module_id;
        if($matiere)
        {
            $matiere->delete();
        }

        return redirect('/modules/'.$mid);
    }
}
