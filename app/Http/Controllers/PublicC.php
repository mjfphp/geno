<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicC extends Controller
{
  public function index(Request $request)
  {
      if($request->isMethod('post'))
      {
          $email=$request->input('email');
          $password=$request->input('password');


          if($email=="sup@sup.com")
              if($password=="123456") {
                  $request->session()->put('admin', 'superuser');
                  return redirect('/s');
              }
              else
              {
                  return redirect('/')->with('erreur','Mot de passe incorrecte ')
                  ->withInput();
              }

          else
              return redirect('/')->with('erreur',"Cet email n'existe pas ")
                  ->withInput();
      }
      else
          if($request->session()->has('admin'))
              return redirect('/s');
          else
              return view("users.connexion");
  }
}
