<?php

namespace App\Imports;

use App\Models\kelas;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $cekKelas = $row['kelas'];

        if (preg_match('/^(.+)-(\d+[A-Z]*)$/', $row['kelas'], $matches)) {
            $cekKelas = $matches[1] . ' - ' . $matches[2];
        }

        $namaKelas = kelas::where('kelas', $cekKelas)->first();

        return new mahasiswa([
            'NIM'           => $row['nim'],
            'password'      => bcrypt($row['nim']),
            'namaLengkap'   => $row['nama_lengkap'],
            'id_kelas'      => $namaKelas->id,
            'jenisKelamin'  => $row['jenis_kelamin'],
            'NoTelp'        => $row['nomor_telepon'],
            'tahunMasuk'    => $row['tahun_masuk'],
            'nama_Ayah'     => $row['nama_ayah'],
            'NoTelp_Ayah'   => $row['nomor_telepon_ayah'],
            'nama_Ibu'      => $row['nama_ibu'],
            'NoTelp_Ibu'    => $row['nomor_telepon_ibu'],
            'Domisili'      => $row['domisili'],
            'Status'        => 'Offline',
        ]);
    }
}
