<?php

namespace App\Http\Controllers;

use App\Module;
use App\Niveau;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Filiere;

class AdminLog extends Controller
{
    public  function logout()
    {
        Session::flush();
        return redirect('/');
    }

    public function home(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'search'=>'required',
                'filter'=>'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $search=$request->input('search');
            $filter=$request->input('filter');
            switch($filter)
            {
                case 0:
                    $filiere=Filiere::where('abbreviation','=',$search)->first();
                    if($filiere)
                        return redirect('filieres/'.$filiere->id);
                    else
                        return redirect('/s')->with('rep','Cette filiere n existe pas !');
                    break;
                case 1:
                    $niveau=Niveau::where('abbreviation','=',$search)->first();
                    if($niveau)
                        return redirect('niveaux/'.$niveau->id);
                    else
                        return redirect('/s')->with('rep',"Ce niveau n'existe pas ! ");
                    break;
                case 2:
                    $niveau=Niveau::where('abbreviation','=',$search)->first();
                    if($niveau)
                        return redirect('eleves/'.$niveau->id);
                    else
                        return redirect('/s')->with('rep',"Ce niveau n'existe pas ! ");
                    break;
                case 3:
                    $module=Module::where('abbreviation','=',$search)->first();
                    if($module)
                        return redirect('modules/'.$module->id);
                    else
                        return redirect('/s')->with('rep',"Ce module n'existe pas ! ");
                    break;
                default:
                    return redirect('/s');

            }
        }
        return view("users.superuser");
    }
}
