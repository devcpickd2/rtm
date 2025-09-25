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
    XrayController,
    MetalController, 
    TahapanController,
    GramasiController,
    IqfController,
    PengemasanController,
    MesinController,
    DisposisiController,
    RepackController,
    RejectController,
    PemusnahanController,
    Verifikasi_sanitasiController,
    ReturController,
    RetainController,
    Sample_bulananController,
    Cold_storageController,
    Sample_retainController,
    SubmissionController, 
    AuthController, 
    UserController,
    DashboardController
};

Route::get('/', function() {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
    Route::resource('user', UserController::class);
});

// routes/api.php
Route::post('api/plant-sync', [UserController::class, 'syncPlant']);
Route::post('api/user-sync', [UserController::class, 'syncUser']);
Route::post('api/user-desync', [UserController::class, 'desyncUser']);

  // Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/set-produksi', [DashboardController::class, 'setProduksi'])->name('set.produksi');

// Route::get('/', fn() => view('dashboard'))->name('dashboard');

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

// Thumbling
Route::resource('thumbling', ThumblingController::class);

// Noodle
Route::resource('noodle', NoodleController::class)->parameters([
    'noodle' => 'uuid'
]);

// Cooking
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

// Metal
Route::resource('metal', MetalController::class)->parameters([
    'metal' => 'uuid'
]);

// Tahapan
Route::resource('tahapan', TahapanController::class)->parameters([
    'tahapan' => 'uuid'
]);

// Gramasi
Route::resource('gramasi', GramasiController::class)->parameters([
    'gramasi' => 'uuid'
]);

// IQF
Route::resource('iqf', IqfController::class)->parameters([
    'iqf' => 'uuid'
]);

// Pengemasan
Route::resource('pengemasan', PengemasanController::class)->parameters([
    'pengemasan' => 'uuid'
]);

// verif mesin
Route::resource('mesin', MesinController::class)->parameters([
    'mesin' => 'uuid'
]);

// verif disposisi
Route::resource('disposisi', DisposisiController::class)->parameters([
    'disposisi' => 'uuid'
]);

// repack
Route::resource('repack', RepackController::class)->parameters([
    'repack' => 'uuid'
]);

// reject
Route::resource('reject', RejectController::class)->parameters([
    'reject' => 'uuid'
]);

// pemusnahan
Route::resource('pemusnahan', PemusnahanController::class)->parameters([
    'pemusnahan' => 'uuid'
]);

// verifikasi sanitasi
Route::resource('verifikasi_sanitasi', Verifikasi_sanitasiController::class)->parameters([
    'verifikasi_sanitasi' => 'uuid'
]);

// retur
Route::resource('retur', ReturController::class)->parameters([
    'retur' => 'uuid'
]);

// retain
Route::resource('retain', RetainController::class)->parameters([
    'retain' => 'uuid'
]);

// sample bulanan
Route::resource('sample_bulanan', Sample_bulananController::class)->parameters([
    'sample_bulanan' => 'uuid'
]);

// cold storage
Route::resource('cold_storage', Cold_storageController::class)->parameters([
    'cold_storage' => 'uuid'
]);

// sample retain
Route::resource('sample_retain', Sample_retainController::class)->parameters([
    'sample_retain' => 'uuid'
]);

// submission
Route::resource('submission', SubmissionController::class)->parameters([
    'submission' => 'uuid'
]);