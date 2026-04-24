<?php

namespace Database\Seeders;

use App\Models\jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            jadwal::create([
                'kode_jadwal' => '3-2-8-20-04-2024-Senin-2022/2023-Audit Sistem Informasi Bisnis-07:00-10:00',
                'kelas' => 3,
                'jurusan' => 2,
                'semester' => 8,
                'tanggal_jadwal' => '20-04-2024',
                'hari' => 'Senin',
                'tahun_akademik' => '2022/2023',
                'matkul' => 'Audit Sistem Informasi Bisnis',
                'jam_mulai' => '07:00',
                'jam_akhir' => '10:00'
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
