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
        return view("users.superuser");
    }
}
