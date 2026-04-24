<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index(){
        $title = "Login";

        return view('Auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $login = $request->input('email');

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $userLogin = Auth::guard('admin')->attempt([
                'email' => $login,
                'password' => $request->input('password')
            ]);

            if ($userLogin) {
                $adminPass = Auth::guard('admin')->user();

                if (Hash::check($request->input('password'), $adminPass->password)) {
                    return redirect()->route('mahasiswa.view');
                }
        } else {
            return back()->withErrors([
                'fail-login' => 'error',
            ]);
        }
    }
}

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();

        Auth::logout();

        return redirect()->route('Login.acc');
    }
}
