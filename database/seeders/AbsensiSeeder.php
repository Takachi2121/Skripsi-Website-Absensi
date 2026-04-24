<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            Absensi::create([
                'NIM' => '2041720211',
                'namaMahasiswa' => 'Andre Maulana Mustofa',
                'kelas' => 'TI - 3D',
                'mataKuliah' => 'Bahasa Inggris 2',
                'semester' => 5,
                'hari' => 'Selasa',
                'tgl_absen' => now()->format('d-m-Y'),
                'jam_absen' => '06.30',
                'status' => 'Tidak Terlambat'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
