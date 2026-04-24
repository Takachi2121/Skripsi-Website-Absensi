<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisController extends Controller
{
    public function index(){
        $title = "Registrasi";

        return view('Auth.regis', compact('title'));
    }

    public function regis(Request $request){
        $akun = new User;

        $akun->username = $request->input('username');
        $akun->namaLengkap = $request->input('namaLengkap');
        $akun->email = $request->input('email');
        $akun->password = Hash::make($request->input('password'));
        $akun->prodi = $request->input('prodi');
        $akun->jurusan = $request->input('jurusan');

        $akun->save();

        return redirect()->route('Login.acc')->withErrors([
            'regis-success' => 'success'
        ]);
    }
}
