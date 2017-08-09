<?php

namespace App\Http\Controllers;

use App\Eleve;
use App\Niveau;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers;

class AelevesC extends Controller
{

    public function index()
    {
        return redirect('/filieres');
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        ]);



        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $eleve = new Eleve;
        $eleve->nom  = $request->input('nom');
        $eleve->prenom= $request->input('prenom');
        $eleve->email  = $request->input('email');
        $eleve->apoge = $request->input('apoge');
        $eleve->cne = $request->input('cne');
        $eleve->cin = $request->input('cin');
        $eleve->lieu_naissance= $request->input('lieu_naissance');
        $eleve->date_naissance= $request->input('date_naissance');
        $eleve->ville = $request->input('ville');
        $eleve->statut = $request->input('statut');
        $eleve->niveau_id=$request->input('niveau_id');
        $eleve->num = $request->input('num');
        $eleve->grp=$request->input('grp');
        $eleve->save();

          return redirect()->back();
    }


    public function show($id)
    {
          $niveau=Niveau::find($id);
          if($niveau)
          {
              return view("users.sufel")
                  ->with('niveau',$niveau)
                  ->with('id',$id);
          }
         else
             return redirect()->back();
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|alpha',
            'prenom'=>'required|alpha',
            'cin'=>'required|unique:eleves,cin,'.$id,
            'cne'=>'required|unique:eleves,cne,'.$id,
            'apoge'=>'required|unique:eleves,apoge,'.$id,
            'email' => 'required|email|unique:eleves,email,'.$id,
            'ville'=>'max:30|nullable|alpha',
            'lieu_naissance'=>'max:30|nullable|alpha',
            'date_naissance'=>'required|',
            'statut'=>'required',
            'num'=>'numeric|min:10|nullable',
            'grp'=>'required'

        ]);



        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $eleve =Eleve::find($id);
        $eleve->nom  = $request->input('nom');
        $eleve->prenom= $request->input('prenom');
        $eleve->email  = $request->input('email');
        $eleve->apoge = $request->input('apoge');
        $eleve->cne = $request->input('cne');
        $eleve->cin = $request->input('cin');
        $eleve->lieu_naissance= $request->input('lieu_naissance');
        $eleve->date_naissance= $request->input('date_naissance');
        $eleve->ville = $request->input('ville');
        $eleve->statut = $request->input('statut');
        $eleve->niveau_id=$eleve->niveau_id;
        $eleve->num = $request->input('num');
        $eleve->grp=$request->input('grp');
        $eleve->save();

        return redirect()->back();
    }


    public function destroy($id)
    {
        $eleve =Eleve::find($id);
        $eleve->delete();
        return redirect()->back();

    }
}
