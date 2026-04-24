<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JadwalController extends Controller
{
    public function view()
    {
        $title = "Jadwal Kuliah";
        $jadwal = jadwal::groupBy('kelas', 'tahun_akademik')->get();
        return view('jadwalKuliah.index', compact('title', 'jadwal'));
    }

    public function create(Request $request)
    {
        $title = "Buat Jadwal";
        $kelas = kelas::all();
        $jurusan = Jurusan::all();

        return view('jadwalKuliah.create', compact('title', 'kelas', 'jurusan'));
    }

    public function storeJadwal(Request $request)
    {
        $repeat = $request->input('jmlRepeat');
        $start_date = strtotime($request->input('tanggal_jadwal'));
        $hari_date = strtotime($request->input('hari'));

        function HariIndonesia($day)
        {
            $days = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];

            return $days[$day];
        }

        for ($i = 0; $i < $repeat; $i++) {
            $jadwal = new Jadwal;

            $jadwal->kelas          = $request->input('kelas');
            $jadwal->jurusan        = $request->input('jurusan');
            $jadwal->semester       = $request->input('semester');
            $jadwal->hari           = HariIndonesia(date('l', strtotime("+{$i} week", $hari_date)));
            $jadwal->matkul         = $request->input('matkul');
            $jadwal->tanggal_jadwal = date('d-m-Y', strtotime("+{$i} week", $start_date));
            $jadwal->tahun_akademik = $request->input('tahunAkademik') . '/' . $request->input('tahunAkademik2');
            $jadwal->jam_mulai      = date('H:i', strtotime($request->input('jam_mulai')));
            $jadwal->jam_akhir      = date('H:i', strtotime($request->input('jam_akhir')));

            $kombinasi = "{$jadwal->kelas}-{$jadwal->jurusan}-{$jadwal->semester}-{$jadwal->tanggal_jadwal}-{$jadwal->hari}-{$jadwal->tahun_akademik}-{$jadwal->matkul}-{$jadwal->jam_mulai}-{$jadwal->jam_akhir}";
            $jadwal->kode_jadwal = Hash::make($kombinasi);

            $jadwal->save();
        }

        return redirect()->route('jadwal.view');
    }

    public function getKelas($jur_id)
    {
        $kelas = kelas::where('jur_id', $jur_id)->groupBy('kelas')->pluck('kelas', 'id');

        return response()->json($kelas);
    }

    public function getMatkul($kelas, $semesterKls)
    {
        $semester = Kelas::where('kelas', $kelas)->where('semester', $semesterKls)->first();

        if ($semester) {
            $options = [
                'id' => $semester->id,
                'matkul_1' => $semester->matkul_1,
                'matkul_2' => $semester->matkul_2,
                'matkul_3' => $semester->matkul_3,
                'matkul_4' => $semester->matkul_4,
                'matkul_5' => $semester->matkul_5,
                'matkul_6' => $semester->matkul_6,
                'matkul_7' => $semester->matkul_7,
                'matkul_8' => $semester->matkul_8
            ];

            return response()->json($options);
        }
    }

    public function editJadwal($id)
    {
        $title = "Edit Jadwal";

        $jadwal = Jadwal::find($id);
        $kelas  = Kelas::all();
        $jurusan = Jurusan::all();

        $tahunAkademik = $jadwal->tahun_akademik;
        list($tahunAkademik1, $tahunAkademik2) = explode('/', $tahunAkademik);

        return view('jadwalKuliah.edit', compact('title', 'jadwal', 'kelas', 'jurusan', 'tahunAkademik1', 'tahunAkademik2'));
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);

        $jadwal->kelas = $request->input('kelas');
        $jadwal->jurusan = $request->input('jurusan');
        $jadwal->semester = $request->input('semester');
        $jadwal->tanggal_jadwal = date('d-m-Y', strtotime($request->input('tanggal_jadwal')));
        $jadwal->hari = $request->input('hari');
        $jadwal->tahun_akademik = $request->input('tahunAkademik') . '/' . $request->input('tahunAkademik2');
        $jadwal->matkul = $request->input('matkul');
        $jadwal->jam_mulai = $request->input('jam_mulai');
        $jadwal->jam_akhir = $request->input('jam_akhir');

        $jadwal->update();

        return redirect()->route('jadwal.view');
    }

    public function deleteJadwal($id)
    {
        Jadwal::find($id)->delete();

        return redirect()->route('jadwal.view');
    }

    public function check(Request $request)
    {
        $kelas          = $request->kelas;
        $jurusan        = $request->jurusan;
        $semester       = $request->semester;
        $hari           = $request->hari;
        $matkul         = $request->matkul;
        $tanggal_jadwal = $request->tanggal_jadwal;
        $tahunAkademik  = $request->tahunAkademik;
        $jam_mulai      = $request->jam_mulai;
        $jam_akhir      = $request->jam_akhir;

        $kombinasi      = "$kelas-$jurusan-$semester-$tanggal_jadwal-$hari-$tahunAkademik-$matkul-$jam_mulai-$jam_akhir";

        echo "Kombinasi yang dicari: " . $kombinasi;
        flush();

        $jadwals = Jadwal::all();
        $checking = false;

        foreach ($jadwals as $jadwal) {
            if (Hash::check($kombinasi, $jadwal->kode_jadwal)) {
                $checking = true;
                break;
            }
        }

        echo "Checking Status: " . $checking;

        // $checking       = Jadwal::where('kode_jadwal', $kombinasi)->exists();

        return response()->json(['checking' => $checking]);
    }
}
