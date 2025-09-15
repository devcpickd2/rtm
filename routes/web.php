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
    RiceController
};

use Spatie\LaravelPdf\Facades\Pdf;

Route::get('/pdf/verifikasi-premix', function () {
    return Pdf::view('pdf.verifikasi-premix', [
            'company'  => 'PT Contoh Pangan Indonesia',
            'doc_code' => 'QF-2009',
            'tanggal'  => now()->format('d/m/Y'),
            'shift'    => '1',
            'rows'     => 28, // ubah sesuai kebutuhan
        ])
        ->format('a4')
        ->name('verifikasi-premix.pdf'); // tampilkan/download di browser
});

Route::get('/pdf/verifikasi-produk-institusi', function () {
    return Pdf::view('pdf.verifikasi-produk-institusi', [
            'tanggal' => now()->format('d/m/Y'),
            'shift'   => '1',
            'rows'    => 18,
            'doc_code'=> 'QR-3101',
        ])
        ->format('a4')
        ->name('verifikasi-produk-institusi.pdf');
});

Route::get('/pdf/peneraan-timbangan', function () {
    return Pdf::view('pdf.peneraan-timbangan', [
            'tanggal'  => now()->format('d/m/Y'),
            'shift'    => '1',
            'rows'     => 8,          // ubah sesuai kebutuhan
            'doc_code' => 'QR 13/01', // pojok kanan bawah
        ])
        ->format('a4')
        ->name('peneraan-timbangan.pdf');
});

Route::get('/pdf/peneraan-termometer', function () {
    return Pdf::view('pdf.peneraan-termometer', [
            'tanggal'  => now()->format('d/m/Y'),
            'shift'    => '1',
            'rows'     => 6,
            'doc_code' => 'QR 04/01',
        ])
        ->format('a4')
        ->name('peneraan-termometer.pdf');
});

Route::get('/pdf/sortasi-bahan-baku', function () {
    return Pdf::view('pdf.sortasi-bahan-baku', [
            'tanggal'  => now()->format('d/m/Y'),
            'shift'    => '1',
            'rows'     => 14,
            'doc_code' => 'QR 27/09',
        ])
        ->format('a4')
        ->name('sortasi-bahan-baku.pdf');
});

Route::get('/pdf/pemeriksaan-thawing', function () {
    return Pdf::view('pdf.pemeriksaan-thawing', [
            'tanggal'  => now()->format('d/m/Y'),
            'rows'     => 8,
            'doc_code' => 'QR 20/09',
        ])
        ->format('a4')
        ->landscape() // karena tabel lebar
        ->name('pemeriksaan-thawing.pdf');
});

Route::get('/pdf/parameter-saus-yoshinoya', function () {
    return Pdf::view('pdf.parameter-saus-yoshinoya', [
            'zona'  => 'Zona 1',
            'saus'  => 'Yoshinoya',
            'shift' => '1',
            'rows'  => 30,
            'specs' => [
                'suhu'       => '24 – 26',
                'brix'       => '62 – 63',
                'salt'       => '1.7 – 2.0',
                'viscositas' => '70 – 280',
                'bf1'        => '3000 – 7000 cP',
                'bf2'        => '3000 – 7000 cP',
            ],
        ])
        ->format('a4')
        ->name('parameter-saus-yoshinoya.pdf');
});

Route::get('/pdf/pemeriksaan-steamer', function () {
    return Pdf::view('pdf.pemeriksaan-steamer', [
            'tanggal' => now()->format('d/m/Y'),
            'shift'   => '1',
            'produk'  => 'Chicken Fillet',
            'doc_code'=> 'QF 07/07',
        ])
        ->format('a4')
        ->name('pemeriksaan-steamer.pdf');
});

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
