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
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\RegisteredUserController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
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
    Route::resource('presensi-pelajaran', AbsensiPelajaranController::class);
    Route::get('/presensi/{id}', [PresensiController::class, 'index']);
    Route::post('/presensi/{id}', [PresensiController::class, 'update']);
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
});

require __DIR__.'/auth.php';

// Route::get('/agenda-guru', function() {
//     return view('agenda.guru');
// });

Route::get('/agenda-siswa', function() {
    return view('agenda.siswa');
});

Route::get('/agenda-siswa', function() {
    return view('agenda.siswa');
}); 

Route::get('/absensi-guru', function() {
    return view('users.absensiguru');
});

Route::get('/detail-absensi-guru', function() {
    return view('users.detailabsensiguru');
});

Route::get('/absensi-siswa', function() {
    return view('users.absensisiswa');
});

Route::get('/detail-absensi-siswa', function() {
    return view('users.detailabsensisiswa');
});

Route::get('/create-agenda-guru', function() {
    return view('agenda.createagendaguru');
});

Route::get('/create-agenda-siswa', function() {
    return view('agenda.createagendasiswa');
});

Route::get('/forgot-password', function() {
    return view('myauth.forgot-password');
});

Route::get('/user-settings', function() {
    return view('myauth.settings');
});

Route::get('/register', function() {
    return view('myauth.register');
});

Route::get('/input-absensi', function() {
    return view('absensipelajaran.input');
});

Route::get('/edit-profile', function() {
    return view('myauth.editprofile');
});


