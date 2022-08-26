<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\RegisteredUserController;

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
    Route::get('users/{role}', [UserController::class, 'index']);
    Route::resource('siswa', SiswaController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::get('/import', [SiswaController::class, 'import']);
    Route::post('/import', [SiswaController::class, 'saveimport']);
});

require __DIR__.'/auth.php';

Route::get('/create-siswa', function() {
    return view('create.siswa');
});

Route::get('/create-guru', function() {
    return view('create.guru');
});

Route::get('/agenda-guru', function() {
    return view('agenda.guru');
});

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

