<?php

namespace Database\Seeders;

use App\Models\kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            kelas::create([
                'kelas' => 'TI - 4D',
                'jur_id' => '1',
                'semester' => 8,
                'nama_DPA' => 'Dimas Wahyu Wibowo, ST., MT.',
                'matkul_1' => 'Pengembangan Karir'
            ]);
            kelas::create([
                'kelas' => 'SIB - 4C',
                'jur_id' => '2',
                'semester' => 8,
                'nama_DPA' => 'Putra Prima A., ST., M.Kom',
                'matkul_1' => 'Audit Sistem Informasi Bisnis'
            ]);
            kelas::create([
                'kelas' => 'SIB - 4E',
                'jur_id' => '2',
                'semester' => 8,
                'nama_DPA' => 'Muhammad Shulhan Khairy, S.Kom, M.Kom',
                'matkul_1' => 'Audit Sistem Informasi Bisnis'
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
