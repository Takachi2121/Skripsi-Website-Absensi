<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            User::create([
                'username' => 'Admin JTI',
                'email' => 'jtipolinema@gmail.com',
                'password' => Hash::make('admin1442'),
                'namaLengkap' => 'Admin Jurusan Teknologi Informasi',
                'prodi' => 'D4 Teknik Informatika',
                'jurusan' => 'Teknologi Informasi',
                'alamat' => 'Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141',
                'imgProfile' => 'polinema_logo.png'
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
