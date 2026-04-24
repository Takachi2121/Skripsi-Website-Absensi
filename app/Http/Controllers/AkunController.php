<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index(){
        $title = "Akun Mahasiswa";
        $mahasiswa = mahasiswa::join('kelas','kelas.id','=','mahasiswas.id_kelas')->select('*')->get();

        return view('akunMahasiswa.index', compact('title', 'mahasiswa'));
    }

    
}