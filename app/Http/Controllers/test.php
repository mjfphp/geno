<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Departement;
use Validator;
use  Illuminate\Validation\Rule;

class test extends Controller
{

    public function index()
    {
        return redirect('/filieres');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'intitule'=>'required|unique:departements',
            'user_id'=>'nullable'


        ]);



        if ($validator->fails()) {
            return redirect('/filieres')
                ->withErrors($validator)
                ->withInput();
        }

        $dept = new Departement;

      $dept->intitule = $request->input('intitule');
      $dept->user_id = $request->input('user_id');
      $dept->save();

        return redirect('/filieres');
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all($id), [
            'intitule'=>['required',Rule::unique('departements')->ignore($id)],
            'user_id'=>'required'


        ]);



        if ($validator->fails()) {
            return redirect('/filieres')
                ->withErrors($validator)
                ->withInput();
        }

      $dept = Departement::find($id);
      $dept->intitule = $request->input('intitule');
      $dept->user_id = $request->input('user_id');
      $dept->save();

      return redirect('/filieres');
    }


    public function destroy($id)
    {
       $dept = Departement::find($id);
       $dept->delete();
       return redirect('/filieres');
    }
}
