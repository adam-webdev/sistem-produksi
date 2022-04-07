<?php

use App\Http\Controllers\{BahanBakuController, BahanBakuKeluarController, BahanBakuMasukController, DashboardController, FinishGoodController, JadwalProduksiController, LaporanController, PencatatanProduksiController, PermintaanBahanBakuController, StokController, StokFinishGoodController, SupplierController, UserController};
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

Route::resource('/supplier', SupplierController::class);
Route::get('/supplier/hapus/{id}', [SupplierController::class, "delete"]);


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


// Transaksi
// Pembelian
Route::get('pembelian-bahanbaku', [BahanBakuController::class, 'pembelian'])->name('pembelian.index');

Route::get('pembelian-bahanbaku/{id}', [BahanBakuController::class, 'detail'])->name('pembelian.detail');


// store

Route::get('/cek-permintaan-bahanbaku', [PermintaanBahanBakuController::class, "cek_permintaan"])->name('cek-permintaan.index');
Route::get('/cek-permintaan-bahanbaku/{id}', [PermintaanBahanBakuController::class, "edit_permintaan"])->name('cek-permintaan.edit');
Route::put('/cek-permintaan-bahanbaku/{id}', [PermintaanBahanBakuController::class, "update_permintaan"])->name('cek-permintaan.update');
Route::post('/cek-permintaan-bahanbaku', [PermintaanBahanBakuController::class, "filter_tanggal"])->name('cek-permintaan.filter');

// cek jadwal produksi
Route::get('/cek-jadwalproduksi', [JadwalProduksiController::class, "cekjadwalproduksi"])->name('cek-jadwalproduksi.index');

Route::resource('/user', UserController::class);
Route::get('/user/hapus/{id}', [UserController::class, "delete"]);


Route::resource('/stok', StokController::class);
Route::get('/stok/hapus/{id}', [StokController::class, "delete"]);

//stok finish good
Route::resource('/stokfinishgood', StokFinishGoodController::class);
Route::get('/stokfinishgood/hapus/{id}', [StokFinishGoodController::class, "delete"]);

// laporan

// laporan bahan  baku
Route::get('/laporan-bahanbaku', [LaporanController::class, 'view_bahanbaku'])->name('laporan.bahanbaku');
Route::post('/laporan-bahanbaku', [LaporanController::class, 'bahan_baku'])->name('laporan.bahanbaku.print');

// laporan supplier
Route::get('/laporan-supplier', [LaporanController::class, 'view_supplier'])->name('laporan.supplier');
Route::post('/laporan-supplier', [LaporanController::class, 'supplier'])->name('laporan.supplier.print');

// laporan bahan baku keluar
Route::get('/laporan-bahanbaku-keluar', [LaporanController::class, 'view_bahanbaku_keluar'])->name('laporan.bahanbaku_keluar');
Route::post('/laporan-bahanbaku-keluar', [LaporanController::class, 'bahan_baku_keluar'])->name('laporan.bahanbaku-keluar.print');

// laporan bahan baku masuk
Route::get('/laporan-bahanbaku-masuk', [LaporanController::class, 'view_bahanbaku_masuk'])->name('laporan.bahanbaku_masuk');
Route::post('/laporan-bahanbaku-masuk', [LaporanController::class, 'bahan_baku_masuk'])->name('laporan.bahanbaku-masuk.print');

// laporan finish good
Route::get('/laporan-finishgood', [LaporanController::class, 'view_finishgood'])->name('laporan.finishgood');
Route::post('/laporan-finishgood', [LaporanController::class, 'finish_good'])->name('laporan.finishgood.print');

// laporan jadwal produksi
Route::get('/laporan-jadwalproduksi', [LaporanController::class, 'view_jadwalproduksi'])->name('laporan.jadwalproduksi');
Route::post('/laporan-jadwalproduksi', [LaporanController::class, 'jadwal_produksi'])->name('laporan.jadwalproduksi.print');

// laporan pencatatan produksi
Route::get('/laporan-pencatatanproduksi', [LaporanController::class, 'view_pencatatanproduksi'])->name('laporan.pencatatanproduksi');
Route::post('/laporan-pencatatanproduksi', [LaporanController::class, 'pencatatan_produksi'])->name('laporan.pencatatanproduksi.print');

// laporan permintaan bahan baku
Route::get('/laporan-permintaanbahanbaku', [LaporanController::class, 'view_permintaanbahanbaku'])->name('laporan.permintaanbahanbaku');
Route::post('/laporan-permintaanbahanbaku', [LaporanController::class, 'permintaan_bahan_baku'])->name('laporan.permintaanbahanbaku.print');

// laporan stok
Route::get('/laporan-stok', [LaporanController::class, 'view_stok'])->name('laporan.stok');
Route::post('/laporan-stok', [LaporanController::class, 'stok'])->name('laporan.stok.print');
Route::get('/laporan-stokfinishgood', [LaporanController::class, 'view_stokfinishgood'])->name('laporan.stokfinishgood');
Route::post('/laporan-stokfinishgood', [LaporanController::class, 'stokfinishgood'])->name('laporan.stokfinishgood.print');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');