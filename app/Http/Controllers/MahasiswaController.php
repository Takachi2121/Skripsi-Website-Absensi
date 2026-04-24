<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaImport;
use App\Models\kelas;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function view()
    {
        $mahasiswa = mahasiswa::join('kelas', 'kelas.id', '=', 'mahasiswas.id_kelas')->select('mahasiswas.*')->orderBy('mahasiswas.id', 'asc')->get();
        $title = "Mahasiswa";
        return view('dataMahasiswa.index', compact('mahasiswa', 'title'));
    }

    public function create()
    {
        $title = "Buat Data Mahasiswa";
        $kelas = kelas::all();
        return view('dataMahasiswa.create', compact('title', 'kelas'));
    }

    public function store(Request $request)
    {
        $mahasiswa = new Mahasiswa;

        // Mahasiswa
        $mahasiswa->NIM = $request->input('NIM');
        $mahasiswa->password = bcrypt($request->input('NIM'));
        $mahasiswa->namaLengkap = $request->input('nama_lengkap');
        $mahasiswa->id_kelas = $request->input('kelas');
        $mahasiswa->jenisKelamin = $request->input('jenisKelamin');
        $mahasiswa->NoTelp = $request->input('NomorTelp');
        $mahasiswa->tahunMasuk = $request->input('tahunMasuk');

        // Ortu
        $mahasiswa->nama_Ayah = $request->input('namaAyah');
        $mahasiswa->NoTelp_Ayah = $request->input('NomorAyah');
        $mahasiswa->nama_Ibu = $request->input('namaIbu');
        $mahasiswa->NoTelp_Ibu = $request->input('NomorIbu');

        // Domisili / Tempat tinggal sekarang
        $mahasiswa->Domisili = $request->input('provinsiIndo');

        $mahasiswa->save();

        return redirect()->route('mahasiswa.view');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $kelas = Kelas::all();
        $title = "Edit Data";
        return view('dataMahasiswa.edit', compact('title', 'kelas', 'mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        // Mahasiswa
        $mahasiswa->NIM = $request->input('NIM');
        $mahasiswa->password = bcrypt($request->input('NIM'));
        $mahasiswa->namaLengkap = $request->input('nama_lengkap');
        $mahasiswa->id_kelas = $request->input('kelas');
        $mahasiswa->jenisKelamin = $request->input('jenisKelamin');
        $mahasiswa->NoTelp = $request->input('NomorTelp');
        $mahasiswa->tahunMasuk = $request->input('tahunMasuk');

        // Ortu
        $mahasiswa->nama_Ayah = $request->input('namaAyah');
        $mahasiswa->NoTelp_Ayah = $request->input('NomorAyah');
        $mahasiswa->nama_Ibu = $request->input('namaIbu');
        $mahasiswa->NoTelp_Ibu = $request->input('NomorIbu');

        // Domisili / Tempat tinggal sekarang
        $mahasiswa->Domisili = $request->input('provinsiIndo');

        $mahasiswa->update();

        return redirect()->route('mahasiswa.view');
    }

    public function delete($id)
    {
        Mahasiswa::find($id)->delete();

        return redirect()->route('mahasiswa.view');
    }

    public function showImportForm()
    {
        return view('dataMahasiswa.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new MahasiswaImport, $request->file('file')->store('temp'));

        return back()->withErrors([
            'upload-alert' => 'error',
        ]);
    }
}
