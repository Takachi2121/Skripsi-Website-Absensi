<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Absensi extends Model
{
    use Notifiable;

    protected $fillable = [
        'NIM',
        'namaMahasiswa',
        'kelas',
        'semester',
        'mataKuliah',
        'hari',
        'tgl_absen',
        'jam_absen',
        'status'
    ];

    public $timestamps = false;
}
