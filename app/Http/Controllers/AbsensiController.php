<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\jadwal;
use App\Models\Jurusan;
use App\Models\kelas;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function index()
    {
        $title = "Data Absensi";
        $absensi = Absensi::all();

        return view('Absensi.index', compact('title', 'absensi'));
    }

    public function getAbsensi($status)
    {
        $getStatus = Absensi::where('status', $status)->get();

        return view('Absensi.getStatus', compact('getStatus'));
    }

    public function getAbsensibyDate($tgl_absen)
    {
        $getStatus = Absensi::where('tgl_absen', $tgl_absen)->get();

        return view('Absensi.getStatus', compact('getStatus'));
    }

    public function getAbsensibyDateRange($tglawal, $tglakhir)
    {
        $getStatus = Absensi::whereBetween('tgl_absen', [$tglawal, $tglakhir])->get();
        return view('Absensi.getStatus', compact('getStatus'));
    }

    public function delete($id)
    {
        Absensi::find($id)->delete();

        return redirect()->route('Absensi.index');
    }

    public function create()
    {
        $title = "Tambah Data";
        $kelas = kelas::all();
        $mahasiswa = mahasiswa::all();

        return view('Absensi.create', compact('title', 'kelas', 'mahasiswa'));
    }

    public function getMahasiswa($NIM)
    {
        $mahasiswa = mahasiswa::where('NIM', $NIM)->first();

        return response()->json($mahasiswa);
    }

    public function getKelas($id)
    {
        $kelas = Kelas::find($id);

        return response()->json($kelas);
    }

    public function store(Request $request)
    {
        $absen = new Absensi;
        $id_kelas = $request->input('kelas');
        $kelas = kelas::where('id', $id_kelas)->first();
        $namaKelas = $kelas->kelas;

        $absen->NIM = $request->input('NIM');
        $absen->namaMahasiswa = $request->input('namaMahasiswa');
        $absen->kelas = $namaKelas;
        $absen->mataKuliah = $request->input('matkul');
        $absen->semester = $request->input('semester');
        $absen->hari = $request->input('hari');
        $absen->tgl_absen = date('d-m-Y', strtotime($request->input('tgl_absen')));
        $absen->jam_absen = date('H:i', strtotime($request->input('absen')));
        $absen->status = $request->input('status');

        $absen->save();

        return redirect()->route('absensi.view');
    }

    function download($tgl_absen)
    {
        return Excel::download(new AbsensiExport($tgl_absen), 'Laporan Absensi ' . $tgl_absen . '.xlsx');
    }
}
