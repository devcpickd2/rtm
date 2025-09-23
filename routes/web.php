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
    RiceController,
    NoodleController,
    CookingController,
    KontaminasiController,
    XrayController
};

// Halo test
Route::get('/halo', [HaloController::class, 'index']);

// Dashboard
Route::get('/', fn() => view('dashboard'))->name('dashboard');

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
Route::get('premix/export-pdf', [PremixController::class, 'exportPdf'])->name('premix.exportPdf');
Route::resource('premix', PremixController::class)->parameters([
    'premix' => 'uuid'
]);

// Institusi
Route::get('institusi/export-pdf', [InstitusiController::class, 'exportPdf'])->name('institusi.exportPdf');
Route::resource('institusi', InstitusiController::class)->parameters([
    'institusi' => 'uuid'
]);

// Timbangan
Route::get('timbangan/export-pdf', [TimbanganController::class, 'exportPdf'])->name('timbangan.exportPdf');
Route::resource('timbangan', TimbanganController::class)->parameters([
    'timbangan' => 'uuid'
]);

// Thermometer
Route::get('thermometer/export-pdf', [ThermometerController::class, 'exportPdf'])->name('thermometer.exportPdf');
Route::resource('thermometer', ThermometerController::class)->parameters([
    'thermometer' => 'uuid'
]);

// Sortasi
Route::get('sortasi/export-pdf', [SortasiController::class, 'exportPdf'])->name('sortasi.exportPdf');
Route::resource('sortasi', SortasiController::class)->parameters([
    'sortasi' => 'uuid'
]);

// Thawing
Route::get('thawing/export-pdf', [ThawingController::class, 'exportPdf'])->name('thawing.exportPdf');
Route::resource('thawing', ThawingController::class)->parameters([
    'thawing' => 'uuid'
]);

// Yoshinoya
Route::get('yoshinoya/export-pdf', [YoshinoyaController::class, 'exportPdf'])->name('yoshinoya.exportPdf');
Route::resource('yoshinoya', YoshinoyaController::class)->parameters([
    'yoshinoya' => 'uuid'
]);

// Steamer
Route::get('steamer/export-pdf', [SteamerController::class, 'exportPdf'])->name('steamer.exportPdf');
Route::resource('steamer', SteamerController::class)->parameters([
    'steamer' => 'uuid'
]);

// Rice
Route::get('rice/export-pdf', [RiceController::class, 'exportPdf'])->name('rice.exportPdf');
Route::resource('rice', RiceController::class)->parameters([
    'rice' => 'uuid'
]);

// Thumbling
Route::get('thumbling/export-pdf', [ThumblingController::class, 'exportPdf'])->name('thumbling.exportPdf');
Route::resource('thumbling', ThumblingController::class);

// Noodle
Route::get('noodle/export-pdf', [NoodleController::class, 'exportPdf'])->name('noodle.exportPdf');
Route::resource('noodle', NoodleController::class)->parameters([
    'noodle' => 'uuid'
]);

// Cooking
Route::get('cooking/export-pdf', [CookingController::class, 'exportPdf'])->name('cooking.exportPdf');
Route::resource('cooking', CookingController::class)->parameters([
    'cooking' => 'uuid'
]);

// Kontaminasi
Route::resource('kontaminasi', KontaminasiController::class)->parameters([
    'kontaminasi' => 'uuid'
]);

// XRay
Route::resource('xray', XrayController::class)->parameters([
    'xray' => 'uuid'
]);
