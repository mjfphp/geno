<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminLog extends Controller
{
    public  function logout(Request $request)
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

        }
        return view("users.superuser");
    }
}
