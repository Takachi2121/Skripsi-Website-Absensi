<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwal');
            $table->string('kelas');
            $table->string('jurusan');
            $table->string('semester');
            $table->string('hari');
            $table->string('matkul');
            $table->string('tanggal_jadwal');
            $table->string('tahun_akademik');
            $table->time('jam_mulai');
            $table->time('jam_akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
