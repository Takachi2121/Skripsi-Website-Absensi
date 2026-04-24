<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\User\Controller;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route Login
Route::get('/', [LoginController::class, 'index'])->name('Login.acc');
Route::post('/', [LoginController::class, 'login'])->name('login.auth');
Route::get('logout', [LoginController::class, 'logout'])->name('logout.acc');

Route::get('daftar', [RegisController::class, 'index'])->name('Regis.acc');
Route::post('daftar', [RegisController::class, 'regis'])->name('Regis.auth');

Route::middleware(['admin.auth'])->group(function(){

    Route::prefix('Mahasiswa')->group(function(){
        Route::get('/', [MahasiswaController::class, 'view'])->name('mahasiswa.view');
        Route::get('createData', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('storeData', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::get('editData/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('updateData/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('deleteData/{id}', [MahasiswaController::class, 'delete'])->name('mahasiswa.delete');
        Route::get('import', [MahasiswaController::class, 'showImportForm'])->name('mahasiswa.showImport');
        Route::post('import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
    });

    Route::prefix('Jurusan')->group(function(){
        Route::get('/', [JurusanController::class, 'index'])->name('jurusan.view');
        Route::post('storeData', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::put('updateData/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('deleteData/{id}', [JurusanController::class, 'delete'])->name('jurusan.delete');
    });

    Route::prefix('Kelas')->group(function(){
        Route::get('/', [KelasController::class, 'view'])->name('kelas.view');
        Route::get('createKelas', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('storeKelas', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('editKelas/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::put('updateKelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
        Route::delete('deleteKelas/{id}', [KelasController::class, 'delete'])->name('kelas.delete');
    });

    Route::prefix('JadwalKuliah')->group(function () {
        Route::get('/', [JadwalController::class, 'view'])->name('jadwal.view');
        Route::get('createJadwal', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::get('getKelas/{jur_id}', [JadwalController::class, 'getKelas']);
        Route::get('getMatkul/{kelas}/{semester}', [JadwalController::class, 'getMatkul']);
        Route::post('checkJadwal', [JadwalController::class, 'check'])->name('jadwal.check');
        Route::post('storeJadwal', [JadwalController::class, 'storeJadwal'])->name('jadwal.store');
        Route::get('editJadwal/{id}', [JadwalController::class, 'editJadwal'])->name('jadwal.edit');
        Route::put('updateJadwal/{id}', [JadwalController::class, 'updateJadwal'])->name('jadwal.update');
        Route::delete('deleteJadwal/{id}', [JadwalController::class, 'deleteJadwal'])->name('jadwal.delete');
    });

    Route::prefix('DataAbsensi')->group(function(){
        Route::get('/', [AbsensiController::class, 'index'])->name('absensi.view');
        Route::get('/getAbsensi/{status}', [AbsensiController::class, 'getAbsensi']);
        Route::get('/getAbsensibyDate/{tgl_absen}', [AbsensiController::class, 'getAbsensibyDate']);
        Route::get('/getAbsensibyDateRange/{tglawal}/{tglakhir}', [AbsensiController::class, 'getAbsensibyDateRange']);
        Route::get('/download/{tgl}', [AbsensiController::class, 'download']);
        Route::get('tambahData', [AbsensiController::class, 'create'])->name('absensi.create');
        Route::get('getMahasiswa/{NIM}', [AbsensiController::class, 'getMahasiswa']);
        Route::get('getKelas/{id}', [AbsensiController::class, 'getKelas']);
        Route::post('storeData', [AbsensiController::class, 'store'])->name('absensi.store');
        Route::delete('deleteData/{id}', [AbsensiController::class, 'delete'])->name('absensi.delete');
    });

    Route::prefix('Pengaturan')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('admin.data');
        Route::get('editAdmin', [UserController::class, 'edit'])->name('admin.edit');
        Route::put('updateUser/{id}', [UserController::class, 'updateUser'])->name('admin.update');
        Route::get('Password', [UserController::class, 'indexPassword'])->name('admin.pass');
        Route::put('updatePass/{id}', [UserController::class, 'updatePassword'])->name('pass.update');
        Route::post('imgUpdate/{id}', [UserController::class, 'profile_image_update'])->name('profile.update');
        Route::get('imgDelete/{id}', [UserController::class, 'profile_image_delete'])->name('profile.delete');
    });

    Route::prefix('akunMahasiswa')->group(function(){
        Route::get('/', [AkunController::class, 'index'])->name('akun.home');
    });
});

