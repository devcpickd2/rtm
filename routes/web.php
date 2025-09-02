<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SuhuController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\SanitasiController;
use App\Http\Controllers\Kebersihan_ruangController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\GmpController;
use App\Http\Controllers\PremixController;
use App\Http\Controllers\InstitusiController;
use App\Http\Controllers\TimbanganController; 
use App\Http\Controllers\ThermometerController;
use App\Http\Controllers\SortasiController;
use App\Http\Controllers\ThawingController;
use App\Http\Controllers\YoshinoyaController;

Route::get('/halo', [HaloController::class, 'index']);

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

//departemen
Route::resource('departemen', DepartemenController::class)->parameters(['departemen' => 'departemen']);
Route::get('/departemen-delete-test/{id}', function ($id) {
    \App\Models\Departemen::find($id)->delete();
    return redirect()->route('departemen.index')->with('success', 'Data Berhasil di hapus!!');
});

//plant
Route::get('/plant', [PlantController::class, 'index'])->name('plant.index');
Route::get('/plant/create', [PlantController::class, 'create'])->name('plant.create');
Route::post('/plant', [PlantController::class, 'store'])->name('plant.store');
Route::get('/plant/{uuid}/edit', [PlantController::class, 'edit'])->name('plant.edit');
Route::put('/plant/{uuid}', [PlantController::class, 'update'])->name('plant.update');
Route::delete('/plant/{uuid}', [PlantController::class, 'destroy'])->name('plant.destroy');

//produk
Route::resource('produk', ProdukController::class);
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/{uuid}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{uuid}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{uuid}', [ProdukController::class, 'destroy'])->name('produk.destroy');

//karyawan produksi
Route::resource('produksi', ProduksiController::class);
Route::get('/produksi/create', [ProduksiController::class, 'create'])->name('produksi.create');
Route::post('/produksi/store', [ProduksiController::class, 'store'])->name('produksi.store');
Route::get('/produksi/{uuid}/edit', [ProduksiController::class, 'edit'])->name('produksi.edit');
Route::put('/produksi/{uuid}', [ProduksiController::class, 'update'])->name('produksi.update');
Route::delete('/produksi/{uuid}', [ProduksiController::class, 'destroy'])->name('produksi.destroy');

//suhu
Route::resource('suhu', SuhuController::class);

//sanitasi
Route::resource('sanitasi', SanitasiController::class);
Route::get('/sanitasi/create', [SanitasiController::class, 'create'])->name('sanitasi.create');
Route::post('/sanitasi/store', [SanitasiController::class, 'store'])->name('sanitasi.store');
Route::get('/sanitasi/{uuid}/edit', [SanitasiController::class, 'edit'])->name('sanitasi.edit');
Route::put('/sanitasi/{uuid}', [SanitasiController::class, 'update'])->name('sanitasi.update');
Route::delete('/sanitasi/{uuid}', [SanitasiController::class, 'destroy'])->name('sanitasi.destroy');

//kebersihan ruang
Route::resource('kebersihan_ruang', Kebersihan_ruangController::class);
Route::get('/kebersihan_ruang/create', [Kebersihan_ruangController::class, 'create'])->name('kebersihan_ruang.create');
Route::post('/kebersihan_ruang/store', [Kebersihan_ruangController::class, 'store'])->name('kebersihan_ruang.store');
Route::get('/kebersihan_ruang/{uuid}/edit', [Kebersihan_ruangController::class, 'edit'])->name('kebersihan_ruang.edit');
Route::put('/kebersihan_ruang/{uuid}', [Kebersihan_ruangController::class, 'update'])->name('kebersihan_ruang.update');
Route::delete('/kebersihan_ruang/{uuid}', [Kebersihan_ruangController::class, 'destroy'])->name('kebersihan_ruang.destroy');

//gmp
Route::resource('gmp', GmpController::class);
Route::get('/gmp/create', [GmpController::class, 'create'])->name('gmp.create');
Route::post('/gmp/store', [GmpController::class, 'store'])->name('gmp.store');
Route::get('/gmp/{uuid}/edit', [GmpController::class, 'edit'])->name('gmp.edit');
Route::put('/gmp/{uuid}', [GmpController::class, 'update'])->name('gmp.update');
Route::delete('/gmp/{uuid}', [GmpController::class, 'destroy'])->name('gmp.destroy');

//premix
Route::resource('premix', PremixController::class);
Route::get('/premix/create', [PremixController::class, 'create'])->name('premix.create');
Route::post('/premix/store', [PremixController::class, 'store'])->name('premix.store');
Route::get('/premix/{uuid}/edit', [PremixController::class, 'edit'])->name('premix.edit');
Route::put('/premix/{uuid}', [PremixController::class, 'update'])->name('premix.update');
Route::delete('/premix/{uuid}', [PremixController::class, 'destroy'])->name('premix.destroy');

//institusi
Route::resource('institusi', InstitusiController::class);
Route::get('/institusi/create', [InstitusiController::class, 'create'])->name('institusi.create');
Route::post('/institusi/store', [InstitusiController::class, 'store'])->name('institusi.store');
Route::get('/institusi/{uuid}/edit', [InstitusiController::class, 'edit'])->name('institusi.edit');
Route::put('/institusi/{uuid}', [InstitusiController::class, 'update'])->name('institusi.update');
Route::delete('/institusi/{uuid}', [InstitusiController::class, 'destroy'])->name('institusi.destroy');

//timbangan
Route::resource('timbangan', TimbanganController::class);
Route::get('/timbangan/create', [TimbanganController::class, 'create'])->name('timbangan.create');
Route::post('/timbangan/store', [TimbanganController::class, 'store'])->name('timbangan.store');
Route::get('/timbangan/{uuid}/edit', [TimbanganController::class, 'edit'])->name('timbangan.edit');
Route::put('/timbangan/{uuid}', [TimbanganController::class, 'update'])->name('timbangan.update');
Route::delete('/timbangan/{uuid}', [TimbanganController::class, 'destroy'])->name('timbangan.destroy');

//thermometer
Route::resource('thermometer', ThermometerController::class);
Route::get('/thermometer/create', [ThermometerController::class, 'create'])->name('thermometer.create');
Route::post('/thermometer/store', [ThermometerController::class, 'store'])->name('thermometer.store');
Route::get('/thermometer/{uuid}/edit', [ThermometerController::class, 'edit'])->name('thermometer.edit');
Route::put('/thermometer/{uuid}', [ThermometerController::class, 'update'])->name('thermometer.update');
Route::delete('/thermometer/{uuid}', [ThermometerController::class, 'destroy'])->name('thermometer.destroy');

//sortasi
Route::resource('sortasi', SortasiController::class);
Route::get('/sortasi/create', [SortasiController::class, 'create'])->name('sortasi.create');
Route::post('/sortasi/store', [SortasiController::class, 'store'])->name('sortasi.store');
Route::get('/sortasi/{uuid}/edit', [SortasiController::class, 'edit'])->name('sortasi.edit');
Route::put('/sortasi/{uuid}', [SortasiController::class, 'update'])->name('sortasi.update');
Route::delete('/sortasi/{uuid}', [SortasiController::class, 'destroy'])->name('sortasi.destroy');

//thawing
Route::get('/thawing', [ThawingController::class, 'index'])->name('thawing.index');
Route::get('/thawing/create', [ThawingController::class, 'create'])->name('thawing.create');
Route::post('/thawing', [ThawingController::class, 'store'])->name('thawing.store');
Route::get('/thawing/{uuid}/edit', [ThawingController::class, 'edit'])->name('thawing.edit');
Route::put('/thawing/{uuid}', [ThawingController::class, 'update'])->name('thawing.update');
Route::delete('/thawing/{uuid}', [ThawingController::class, 'destroy'])->name('thawing.destroy');

//yoshinoya
Route::resource('yoshinoya', YoshinoyaController::class);
Route::get('/yoshinoya/create', [YoshinoyaController::class, 'create'])->name('yoshinoya.create');
Route::post('/yoshinoya/store', [YoshinoyaController::class, 'store'])->name('yoshinoya.store');
Route::get('/yoshinoya/{uuid}/edit', [YoshinoyaController::class, 'edit'])->name('yoshinoya.edit');
Route::put('/yoshinoya/{uuid}', [YoshinoyaController::class, 'update'])->name('yoshinoya.update');
Route::delete('/yoshinoya/{uuid}', [YoshinoyaController::class, 'destroy'])->name('yoshinoya.destroy');
