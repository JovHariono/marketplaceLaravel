<?php

// use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    KelasController, ArtikelController,
    OrderController
};

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/admin/artikel', ArtikelController::class);

    Route::resource('/admin/kelas', KelasController::class);

    Route::get('/admin/profile', [ProfilController::class, 'indexProfile']);

    Route::post('/admin/profile', [ProfilController::class, 'updateProfile']);

    Route::get('/siswa/list-kelas', [OrderController::class, 'listKelas']);
    
    Route::get('/siswa/detail-kelas/{id}', [OrderController::class, 'detailKelas']);

    Route::post('/siswa/detail-kelas/beli/{id}', [OrderController::class, 'orderKelas']);

    Route::get('/siswa/pembayaran', [OrderController::class, 'pembayaran']);

    Route::post('/siswa/pembayaran/{id}', [OrderController::class, 'hapusPembayaran']);

    Route::get('/admin/report', [OrderController::class, 'report']);
});
