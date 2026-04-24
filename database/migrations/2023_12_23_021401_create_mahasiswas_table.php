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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->integer('NIM');
            $table->string('password');
            $table->string('namaLengkap');
            $table->string('id_kelas');
            $table->string('jenisKelamin');
            $table->string('NoTelp', 15);
            $table->year('tahunMasuk');
            $table->string('nama_Ayah')->nullable();
            $table->string('NoTelp_Ayah', 15)->nullable();
            $table->string('nama_Ibu')->nullable();
            $table->string('NoTelp_Ibu', 15)->nullable();
            $table->string('Domisili');
            $table->string('Status')->default('Offline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
