<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(){
        $title = "Data Jurusan";
        $jurusan = Jurusan::all();
        return view('Jurusan.index', compact('title', 'jurusan'));
    }

    public function store(Request $request){
        $jurusan = new Jurusan;

        $jurusan->nama_jurusan = $request->input('jurusan');

        $jurusan->save();

        return redirect()->route('jurusan.view');
    }

    public function update(Request $request, $id){
        $jurusan = Jurusan::find($id);

        $jurusan->nama_jurusan = $request->input('jurusan');

        $jurusan->update();

        return redirect()->route("jurusan.view");
    }

    public function delete($id){
        Jurusan::find($id)->delete();

        return redirect()->route("jurusan.view");
    }
}
