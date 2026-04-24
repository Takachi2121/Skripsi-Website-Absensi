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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->integer('NIM');
            $table->string('namaMahasiswa');
            $table->string('kelas');
            $table->string('semester');
            $table->string('mataKuliah');
            $table->string('hari');
            $table->string('tgl_absen');
            $table->string('jam_absen');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
