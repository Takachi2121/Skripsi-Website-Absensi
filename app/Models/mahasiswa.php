<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class mahasiswa extends Model
{
    use Notifiable;

    protected $fillable = [
        'NIM',
        'password',
        'namaLengkap',
        'id_kelas',
        'jenisKelamin',
        'NoTelp',
        'tahunMasuk',
        'nama_Ayah',
        'NoTelp_Ayah',
        'nama_Ibu',
        'NoTelp_Ibu',
        'Domisili',
        'Status'
    ];

    public $timestamps = false;
}
