<?php

namespace App\Http\Controllers;

use App\Matiere;
use App\Module;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Validator;

class AmodulesC extends Controller
{

    public function index()
    {
        return redirect('/filieres');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'intitule' => 'required|unique:modules',
            'abbreviation'=>'required|min:1|max:7|unique:modules',
            'user_id'=>'nullable',
            'vh'=>'numeric|nullable',
            'nature'=>'alpha|nullable'
        ]);



        if ($validator->fails()) {
            return redirect('/niveaux/'.$request->input('niveau_id'))
                ->withErrors($validator)
                ->withInput();
        }

        $module=New Module;
        $module->intitule=$request->input('intitule');
        $module->abbreviation=$request->input('abbreviation');
        $module->user_id=$request->input('user_id');
        $module->semestre=$request->input('semestre');
        $module->vh=$request->input('vh');
        $module->nature=$request->input('nature');
        $module->departement_id=$request->input('departement_id');
        $module->niveau_id=$request->input('niveau_id');

        $module->save();
        return redirect('/niveaux/'.$request->input('niveau_id'));

    }


    public function show($id)
    {
          $module=Module::find($id);
          $profs=User::orderBy('name')->get();
          if($module)
          {
              return view('users.sufmatiere')
                  ->with('module',$module)
                  ->with('profs',$profs);
          }
          else
              return redirect('/filieres');
    }


    public function update(Request $request, $id)
    {

        $module=Module::find($id);

        $validator = Validator::make($request->all(), [
            'intitule' => 'required|unique:modules,intitule,'.$id,
            'abbreviation'=>'required|min:1|max:7|unique:modules,abbreviation,'.$id,
            'user_id'=>'nullable',
            'vh'=>'numeric|nullable',
            'nature'=>'alpha|nullable'
        ]);



        if ($validator->fails()) {
            return redirect('/niveaux/'.$module->niveau_id)
                ->withErrors($validator)
                ->withInput();
        }


        if($module)
        {
            $module->intitule=$request->input('intitule');
            $module->abbreviation=$request->input('abbreviation');
            $module->user_id=$request->input('user_id');
            $module->semestre=$request->input('semestre');
            $module->vh=$request->input('vh');
            $module->nature=$request->input('nature');
            $module->niveau_id=$module->niveau_id;
            $module->departement_id=$request->input('departement_id');

            $module->save();
        }

        return redirect('/niveaux/'.$module->niveau_id);
    }

   // IS DONE
    public function destroy($id)
    {
        $module = Module::find($id);
        $nid=$module->niveau_id;
        if($module)
        {
            $matieres=Matiere::where('module_id',$id)->get();
            foreach($matieres as $mat)
            {
                $mat->delete();
            }
            $module->delete();
        }

        return redirect('/niveaux/'.$nid);
    }
}
