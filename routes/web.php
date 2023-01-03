<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RefAgamaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\JedaPresensiController;
use App\Http\Controllers\RefKabupatenController;
use App\Http\Controllers\RefKecamatanController;
use App\Http\Controllers\RefKelurahanController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\WaktuIstirahatController;
use App\Http\Controllers\WaktuPelajaranController;
use App\Http\Controllers\ConfigurasiUserController;
use App\Http\Controllers\StatusKehadiranController;
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
Route::get('/', function(){
    return view('landingPage');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register',[App\Http\Controllers\User\SekolahController::class, 'create'])->name('register');
    Route::post('/register', [App\Http\Controllers\User\SekolahController::class, 'store'])->name('register.store');
});

Route::prefix('data-master')->group(function () {
    Route::post('kabupaten', [RefKabupatenController::class, 'index'])->name('kabupaten_list');
    Route::post('kecamatan', [RefKecamatanController::class, 'index'])->name('kecamatan_list');
    Route::post('kelurahan', [RefKelurahanController::class, 'index'])->name('kelurahan_list');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class);

    Route::get('edit/sekolah', [App\Http\Controllers\User\SekolahController::class, 'edit'])->name('sekolah.edit.own');
    Route::patch('update/sekolah', [App\Http\Controllers\User\SekolahController::class, 'update'])->name('sekolah.update.own');
    Route::prefix('data-master')->group(function () {
        Route::middleware(['auth.sma_smk'])->group(function () {
            Route::resource('kompetensi', KompetensiController::class);
        });
        Route::resource('kelas', KelasController::class);
        Route::resource('mapel', MapelController::class);
        Route::resource('agama', RefAgamaController::class);
        Route::resource('status-kehadiran', StatusKehadiranController::class);
        Route::resource('tahun-ajaran', TahunAjaranController::class);
    });
       
    Route::get('/absensi/user', [AbsensiController::class, 'show_absensi_user'])->name('absensi.show.user');
    Route::get('/jadwal/user', [AgendaController::class, 'show_agenda_user'])->name('agenda.show.user');

    Route::middleware(['check_role'])->group(function () {
        Route::name('users.')->prefix('users')->group(function () {
            // Route::resource('siswa', SiswaController::class);
            Route::get('{role}', [UserController::class, 'index'])->name('index');
            Route::get('{role}/create', [UserController::class, 'create'])->name('create');
            Route::post('{role}', [UserController::class, 'store'])->name('store');
            Route::get('{role}/{id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::get('{role}/{id}', [UserController::class, 'show'])->name('shows');
            Route::patch('{role}/{id}', [UserController::class, 'update'])->name('update');
        });

        // Export dan Import User
        Route::get('/import/users/{role}', [UserController::class, 'import']);
        Route::post('/import/users/{role}', [UserController::class, 'store_import']);
        Route::get('/export/users/{role}', [UserController::class, 'export']);
        
        Route::name('agenda.')->prefix('agenda')->group(function () {
            Route::get('{role}', [AgendaController::class, 'index'])->name('index');
            Route::post('{role}', [AgendaController::class, 'store'])->name('store');
            Route::get('create/{role}/{id}', [AgendaController::class, 'create'])->name('create');
            Route::get('{role}/{id}', [AgendaController::class, 'show'])->name('show');
            Route::get('{role}/{id}/edit', [AgendaController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [AgendaController::class, 'update'])->name('update');
            Route::delete('/{id}', [AgendaController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::get('{role}', [AbsensiController::class, 'index']);
            Route::get('{role}/{id}', [AbsensiController::class, 'show'])->name('show');
            Route::post('{role}/store', [AbsensiController::class, 'store_update'])->name('store_update');
            Route::get('/export/absensi/{role}', [AbsensiController::class, 'export'])->name('export');
        });
    });

    Route::prefix('absensi-pelajaran')->name('absensi-pelajaran.')->group(function () {
        Route::get('/', [AbsensiPelajaranController::class, 'index'])->name('index');
        Route::get('/create', [AbsensiPelajaranController::class, 'create'])->name('create');
        Route::patch('/{id}', [AbsensiPelajaranController::class, 'update'])->name('update');
        Route::post('/', [AbsensiPelajaranController::class, 'store'])->name('store');
        Route::get('/{id}', [AbsensiPelajaranController::class, 'show'])->name('show');
        Route::get('/{id}/export', [AbsensiPelajaranController::class, 'export'])->name('export');
        Route::get('/{id}/edit', [AbsensiPelajaranController::class, 'edit'])->name('edit');
        Route::post('get-kelas', [AbsensiPelajaranController::class, 'get_kelas'])->name('get-kelas');
        Route::post('/store-update', [PresensiController::class, 'store_update'])->name('presensi.store_update');
        Route::get('/presensi/{id}', [PresensiController::class, 'show'])->name('presensi.show');
    });
    


    // Route::get('/create-agenda', [AgendaController::class, 'create']);
    Route::resource('kelompok', KelompokController::class);
    // Route::resource('agenda', AgendaController::class);
    Route::resource('sekolah', App\Http\Controllers\SekolahController::class);
    Route::resource('jam-pelajaran', WaktuPelajaranController::class);
    Route::resource('jam-istirahat', WaktuIstirahatController::class);
    // Route::resource('tenggat', JedaPresensiController::class);
    // Route::get('/presensi/{id}', [PresensiController::class, 'index']);
    // Route::post('/presensi/{id}', [PresensiController::class, 'update']);
    // Route::get('/presensi-export', [PresensiController::class, 'export']);
    // Route::resource('presensi', PresensiController::class);
    // Route::get('/agenda-guru', [AgendaController::class, 'show_guru']);
    Route::get('get-mapel/{id}', [AgendaController::class, 'get_mapel']);
    // Route::get('/show-absensi', [AbsensiController::class, 'showAbsensi']);
    Route::get('/user-settings', [ConfigurasiUserController::class, 'index']);
    Route::get('/edit-profile', [ConfigurasiUserController::class, 'editProfil']);
    Route::post('/simpan', [ConfigurasiUserController::class, 'saveProfil']);
    Route::get('/ubah-password', [ConfigurasiUserController::class, 'ubahPassword']);
    Route::get('/reset', [ConfigurasiUserController::class, 'reset_password']);
    Route::get('/create-yayasan', [UserController::class, 'createYayasan']);
    Route::post('/create-yayasan', [UserController::class, 'storeYayasan']);
});

require __DIR__.'/auth.php';


