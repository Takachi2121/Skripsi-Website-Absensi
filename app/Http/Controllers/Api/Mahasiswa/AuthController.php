<?php

namespace App\Http\Controllers\Api\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $nim = htmlspecialchars($request->input('nim'));
        $password = htmlspecialchars($request->input('password'));

        $mahasiswa = mahasiswa::where('NIM', $nim)->where('password', $password)->first();

        if ($mahasiswa) {
                Session::put('mahasiswanim', true);
                Session::put('mahasiswaid', $mahasiswa->id);
                $newpass = Str::random(10);
                $mahasiswa->Status = "Online";
                $mahasiswa->password = $newpass;
                $mahasiswa->save();
                $sessi1 = session('mahasiswanim');
                $sessi2 = session('mahasiswaid');
            return response()->json([
                'message' => "Login Success",
                'session1' => $sessi1,
                'session2' => $sessi2,
                'datalogin' => $mahasiswa,
            ], 200);
        } else {
            return response()->json([
                'message' => "Login Failed",
            ] ,401);
        }
    }

    public function logout()
    {
        // Clear the user session
        Session::flush();
        // Redirect to the login page or any other desired page
        return response()->json([
                'message' => "Logout Success", 
            ], 200);
    }
}
