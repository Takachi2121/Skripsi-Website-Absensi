<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class kelas extends Model
{
    use Notifiable;

    protected $fillable = [
        'kelas',
        'jur_id',
        'semester',
        'nama_DPA',
        'matkul_1',
        'matkul_2',
        'matkul_3',
        'matkul_4',
        'matkul_5',
        'matkul_6',
        'matkul_7',
        'matkul_8'
    ];

    public function jadwals(){
        return $this->hasMany(jadwal::class);
    }

    public $timestamps = false;
}
