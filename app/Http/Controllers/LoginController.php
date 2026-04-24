<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        $title = "Login";

        return view('Auth.login', compact('title'));
    }

    public function regis(){
        $title = "Registrasi";

        return view('Auth.login', compact('title'));
    }
}
