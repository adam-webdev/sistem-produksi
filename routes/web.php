<?php

use App\Http\Controllers\{BahanBakuController, BahanBakuKeluarController, BahanBakuMasukController, DashboardController, FinishGoodController, JadwalProduksiController, PencatatanProduksiController, PermintaanBahanBakuController, UserController};
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();
Route::resource('/dashboard', DashboardController::class);

Route::resource('/bahan-baku', BahanBakuController::class);
Route::get('/bahan-baku/hapus/{id}', [BahanBakuController::class, "delete"]);

Route::resource('/bahanbaku-keluar', BahanBakuKeluarController::class);
Route::get('/bahanbaku-keluar/hapus/{id}', [BahanBakuKeluarController::class, "delete"]);

Route::resource('/bahanbaku-masuk', BahanBakuMasukController::class);
Route::get('/bahanbaku-masuk/hapus/{id}', [BahanBakuMasukController::class, "delete"]);

Route::resource('/finish-good', FinishGoodController::class);
Route::get('/finish-good/hapus/{id}', [FinishGoodController::class, "delete"]);

Route::resource('/jadwal-produksi', JadwalProduksiController::class);
Route::get('/jadwal-produksi/hapus/{id}', [JadwalProduksiController::class, "delete"]);

Route::resource('/pencatatan-produksi', PencatatanProduksiController::class);
Route::get('/pencatatan-produksi/hapus/{id}', [PencatatanProduksiController::class, "delete"]);

Route::resource('/permintaan-bahanbaku', PermintaanBahanBakuController::class);
Route::get('/permintaan-bahanbaku/hapus/{id}', [PermintaanBahanBakuController::class, "delete"]);

Route::resource('/user', UserController::class);
Route::get('/user/hapus/{id}', [UserController::class, "delete"]);