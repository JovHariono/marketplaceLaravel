<?php

// use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    KelasController, ArtikelController,
    FrontendController,
    OrderController, CategoryController, RoleAksesController
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

Route::get('/', [FrontendController::class, 'index']);

// Route::get('/artikel', function(){
//     return view('frontend.artikel-details');
// });

Route::get('/artikel-detail/{slug}', [FrontendController::class, 'detailArtikel']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/admin/artikel', ArtikelController::class);

    Route::resource('/admin/kelas', KelasController::class);

    Route::get('/admin/profile', [ProfilController::class, 'indexProfile']);

    Route::post('/admin/profile', [ProfilController::class, 'updateProfile']);

    Route::get('/admin/profile/create_detail', [ProfilController::class, 'index_detail']);

    Route::post('/admin/profile/create_detail', [ProfilController::class, 'detail_post']);

    Route::get('/siswa/list-kelas', [OrderController::class, 'listKelas']);
    
    Route::get('/siswa/detail-kelas/{id}', [OrderController::class, 'detailKelas']);

    Route::post('/siswa/detail-kelas/beli/{id}', [OrderController::class, 'orderKelas']);

    Route::get('/siswa/pembayaran', [OrderController::class, 'pembayaran']);

    Route::post('/siswa/pembayaran/{id}', [OrderController::class, 'hapusPembayaran']);

    Route::get('/admin/report', [OrderController::class, 'report']);

    Route::resource('/admin/category', CategoryController::class);

    // Role Management
    Route::get('/admin/role-akses', [RoleAksesController::class, 'index']);
    
    Route::get('/admin/role-akses/{id}', [RoleAksesController::class, 'show'])->whereNumber('id');
    
    Route::post('/admin/role-akses/{id}', [RoleAksesController::class, 'store_update'])->whereNumber('id');
});
