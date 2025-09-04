<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HaloController,
    ProdukController,
    SuhuController,
    DepartemenController,
    PlantController,
    SanitasiController,
    Kebersihan_ruangController,
    ProduksiController,
    GmpController,
    PremixController,
    InstitusiController,
    TimbanganController,
    ThermometerController,
    SortasiController,
    ThawingController,
    YoshinoyaController,
    SteamerController,
    ThumblingController,
    RiceController
};

// Dashboard
Route::get('/', fn() => view('dashboard'))->name('dashboard');

// Halo test
Route::get('/halo', [HaloController::class, 'index']);

// Departemen
Route::resource('departemen', DepartemenController::class)->parameters([
    'departemen' => 'uuid'
]);
Route::get('/departemen-delete-test/{id}', function ($id) {
    \App\Models\Departemen::find($id)?->delete();
    return redirect()->route('departemen.index')->with('success', 'Data Berhasil dihapus!');
});

// Plant
Route::resource('plant', PlantController::class)->parameters([
    'plant' => 'uuid'
]);

// Produk
Route::resource('produk', ProdukController::class)->parameters([
    'produk' => 'uuid'
]);

// Produksi (Karyawan Produksi)
Route::resource('produksi', ProduksiController::class)->parameters([
    'produksi' => 'uuid'
]);

// Suhu
Route::resource('suhu', SuhuController::class)->parameters([
    'suhu' => 'uuid'
]);

// Sanitasi
Route::resource('sanitasi', SanitasiController::class)->parameters([
    'sanitasi' => 'uuid'
]);

// Kebersihan Ruang
Route::resource('kebersihan_ruang', Kebersihan_ruangController::class)->parameters([
    'kebersihan_ruang' => 'uuid'
]);

// GMP
Route::resource('gmp', GmpController::class)->parameters([
    'gmp' => 'uuid'
]);

// Premix
Route::resource('premix', PremixController::class)->parameters([
    'premix' => 'uuid'
]);

// Institusi
Route::resource('institusi', InstitusiController::class)->parameters([
    'institusi' => 'uuid'
]);

// Timbangan
Route::resource('timbangan', TimbanganController::class)->parameters([
    'timbangan' => 'uuid'
]);

// Thermometer
Route::resource('thermometer', ThermometerController::class)->parameters([
    'thermometer' => 'uuid'
]);

// Sortasi
Route::resource('sortasi', SortasiController::class)->parameters([
    'sortasi' => 'uuid'
]);

// Thawing
Route::resource('thawing', ThawingController::class)->parameters([
    'thawing' => 'uuid'
]);

// Yoshinoya
Route::resource('yoshinoya', YoshinoyaController::class)->parameters([
    'yoshinoya' => 'uuid'
]);

// Steamer
Route::resource('steamer', SteamerController::class)->parameters([
    'steamer' => 'uuid'
]);

// Thumbling
Route::resource('thumbling', ThumblingController::class)->parameters([
    'thumbling' => 'uuid'
]);

// Rice
Route::resource('rice', RiceController::class)->parameters([
    'rice' => 'uuid'
]);
 