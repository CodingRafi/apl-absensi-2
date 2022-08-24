<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KompetensiController;
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
    Route::get('users/{role}', [UserController::class, 'index']);
    Route::resource('siswa', SiswaController::class);
});

require __DIR__.'/auth.php';

Route::get('/create-siswa', function() {
    return view('create.siswa');
});

Route::get('/create-guru', function() {
    return view('create.guru');
});
