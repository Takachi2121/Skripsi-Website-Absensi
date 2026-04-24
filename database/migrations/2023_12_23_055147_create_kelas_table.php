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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->string('jur_id');
            $table->integer('semester');
            $table->string('nama_DPA');
            $table->string('matkul_1')->nullable();
            $table->string('matkul_2')->nullable();
            $table->string('matkul_3')->nullable();
            $table->string('matkul_4')->nullable();
            $table->string('matkul_5')->nullable();
            $table->string('matkul_6')->nullable();
            $table->string('matkul_7')->nullable();
            $table->string('matkul_8')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
