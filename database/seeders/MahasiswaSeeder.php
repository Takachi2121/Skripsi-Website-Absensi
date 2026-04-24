<?php

namespace Database\Seeders;

use App\Models\mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            DB::beginTransaction();

            mahasiswa::create([
                'NIM' => 2041720211,
                'Password' => 2041720211,
                'namaLengkap' => 'Andre Maulana Mustofa',
                'id_kelas' => '1',
                'NoTelp' => 6285233899868,
                'jenisKelamin' => 'Laki-Laki',
                'tahunMasuk' => 2020,
                'nama_Ayah' => 'Henry Mustofa Yudhi Annorsa',
                'NoTelp_Ayah' => 6285233953999,
                'nama_Ibu' => 'Ida Fitriani Rohmah',
                'NoTelp_Ibu' => 6285233609988,
                'Domisili' => 'Ponorogo',
                'Status' => 'Online'
            ]);
            mahasiswa::create([
                'NIM' => 2041720215,
                'Password' => 2041720215,
                'namaLengkap' => 'Rexa Christiani Yuli',
                'id_kelas' => '1',
                'NoTelp' => 628587955645,
                'jenisKelamin' => 'Perempuan',
                'tahunMasuk' => 2020,
                'nama_Ayah' => 'Rico Christian Wilson',
                'NoTelp_Ayah' => 6285233245694,
                'nama_Ibu' => 'Aury Widya Sri',
                'NoTelp_Ibu' => 6285233655694,
                'Domisili' => 'Jakarta Selatan',
                'Status' => 'Offline'
            ]);
            DB::commit();
        }catch (\Throwable $th){
            DB::rollback();
            throw $th;
        }
    }
}
