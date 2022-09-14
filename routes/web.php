<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\JedaPresensiController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ConfigurasiUserController;
use App\Http\Controllers\AbsensiPelajaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/register', function() {
    return view('myauth.register');
});
Route::post('/sekolah-create', [App\Http\Controllers\User\SekolahController::class, 'store']);

Route::group(['middleware' => ['auth:web,websiswa']], function() {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('roles', RoleController::class);
    Route::resource('kompetensi', KompetensiController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('mapel', MapelController::class);
    Route::get('users/{role}', [UserController::class, 'index']);
    Route::get('users/create/{role}', [UserController::class, 'create']);
    Route::resource('users', UserController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::resource('agenda', AgendaController::class);
    Route::get('edit-sekolah', [App\Http\Controllers\SekolahController::class, 'edit']);
    Route::resource('sekolah', App\Http\Controllers\SekolahController::class);
    Route::resource('presensi-pelajaran', AbsensiPelajaranController::class);
    Route::resource('tenggat', JedaPresensiController::class);
    Route::get('/presensi/{id}', [PresensiController::class, 'index']);
    Route::post('/presensi/{id}', [PresensiController::class, 'update']);
    Route::post('/absensi/{id}', [AbsensiController::class, 'update']);
    Route::resource('presensi', PresensiController::class);
    Route::get('/agenda-guru', [AgendaController::class, 'show_guru']);
    Route::get('/absensi/{role}', [AbsensiController::class, 'index']);
    Route::get('get-mapel/{id}', [AgendaController::class, 'get_mapel']);
    Route::get('agenda/kelas/{id}', [AgendaController::class, 'showJadwal']);
    Route::get('/import', [SiswaController::class, 'import']);
    Route::post('/import', [SiswaController::class, 'saveimport']);
    Route::get('/export', [SiswaController::class, 'export']);
    Route::get('/export/absensi', [AbsensiController::class, 'export']);
    Route::get('/import/users/{role}', [UserController::class, 'import']);
    Route::post('/import/users/{role}', [UserController::class, 'saveimport']);
    Route::get('/export/users/{role}', [UserController::class, 'export']);
    Route::get('/show-absensi', [AbsensiController::class, 'showAbsensi']);
    Route::resource('absensi', AbsensiController::class);
    Route::get('/user-settings', [ConfigurasiUserController::class, 'index']);
    Route::get('/edit-profile', [ConfigurasiUserController::class, 'editProfil']);
    Route::post('/simpan', [ConfigurasiUserController::class, 'saveProfil']);
    Route::get('/ubah-password', [ConfigurasiUserController::class, 'ubahPassword']);
    Route::get('/reset', [ConfigurasiUserController::class, 'reset_password']);
    Route::get('/create-yayasan', [UserController::class, 'createYayasan']);
    Route::post('/create-yayasan', [UserController::class, 'storeYayasan']);
});

require __DIR__.'/auth.php';



