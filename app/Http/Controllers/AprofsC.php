<?php

namespace App\Http\Controllers;

use App\Notifications\ActiverCompte;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Departement;
use Validator;
use \Storage;
use Maatwebsite\Excel\Writers\CellWriter;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AprofsC extends Controller
{

    public function index()
    {
        $profs=User::all();
        $depts = Departement::all();
        return view("users.superuser_prof")
            ->with('profs',$profs)
            ->with('depts',$depts);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha',
            'prenom'=>'required|alpha',
            'refprof'=>'required',
            'email' => 'required|unique:users|email',
            'adress'=>'max:255|nullable',
            'ville'=>'max:30|nullable|alpha',
            'num'=>'numeric|min:10|nullable'

        ]);



        if ($validator->fails()) {
            return redirect('/profs')
                ->withErrors($validator)
                ->withInput();
        }
        $email=$request->input('email');
        $prof = new User;
        $prof->name   = $request->input('name');
        $prof->email  = $email;
        $prof->refprof = $request->input('refprof');
        $prof->adress = $request->input('adress');
        $prof->ville = $request->input('ville');
        $prof->specialite = $request->input('specialite');
        $prof->departement_id=$request->input('departement_id');
        $prof->num = $request->input('num');
        $prof->grade = $request->input('grade');
        $prof->prenom= $request->input('prenom');
        $prof->password=Hash::make($p=str_random(8));
        $prof->save();

        $prof=User::where('email',$email)->first();
        $prof->notify(new ActiverCompte($email,$p));




        return redirect('/profs');
    }



    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'prenom'=>'required',
            'refprof'=>'required',
            'email' => 'required|exists:users|email',
            'adress'=>'max:255|nullable',
            'ville'=>'max:30|nullable',
            'num'=>'max:20|min:10|nullable'

        ]);



        if ($validator->fails()) {
            return redirect('/profs')
                ->withErrors($validator)
                ->withInput();
        }

        $prof=User::find($id);
        $prof->name   = $request->input('name');
        $prof->email  = $request->input('email');
        $prof->refprof = $request->input('refprof');
        $prof->adress = $request->input('adress');
        $prof->ville = $request->input('ville');
        $prof->specialite = $request->input('specialite');
        $prof->departement_id=$request->input('departement_id');
        $prof->num = $request->input('num');
        $prof->grade = $request->input('grade');
        $prof->prenom= $request->input('prenom');
        $prof->save();

        return redirect('/profs');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/profs');
    }
}
