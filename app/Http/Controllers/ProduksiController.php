<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi; 
// Import model Produksi agar bisa digunakan di controller

class ProduksiController extends Controller
{
    // Menampilkan semua data produksi
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produksi = \App\Models\Produksi::query()
        ->when($search, function($query, $search) {
            $query->where('nama_karyawan', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10) // 10 item per halaman
        ->withQueryString(); // agar search tetap tersimpan saat pindah halaman

        return view('produksi.index', compact('produksi'));
    }

    // Tampilkan form create
    public function create()
    {
        // Load view form tambah produksi
        return view('produksi.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        // Validasi input agar produksi wajib diisi dan maksimal 255 karakter
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'area' => 'required|string|max:255'
        ]);

        // Ambil username dari session, jika tidak ada gunakan default 'putri'
        // $username = session('username', 'putri');

        // Simpan data ke tabel produksi
        Produksi::create([
            // 'username' => $username,
            'nama_karyawan' => $request->nama_karyawan,
            'area' => $request->area
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('produksi.index')->with('success', 'Produksi berhasil ditambahkan');
    }

    // Tampilkan form edit berdasarkan UUID
    public function edit($uuid)
    {
        // Cari data produksi berdasarkan UUID. Jika tidak ada, tampilkan error 404
        $produksi = Produksi::where('uuid', $uuid)->firstOrFail();

        // Kirim data ke view edit
        return view('produksi.edit', compact('produksi'));
    }

    // Update data produksi berdasarkan UUID
    public function update(Request $request, $uuid)
    {
        // Validasi input
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'area' => 'required|string|max:255'
        ]);

        // Cari produksi berdasarkan UUID. Jika tidak ketemu, tampilkan 404
        $produksi = Produksi::where('uuid', $uuid)->firstOrFail();

        // Update kolom produksi saja
        $produksi->update([
            'nama_karyawan' => $request->nama_karyawan,
            'area' => $request->area
        ]);

        // Redirect ke halaman index
        return redirect()->route('produksi.index')->with('success', 'Produksi berhasil diupdate');
    }

    // Hapus data produksi berdasarkan UUID
    public function destroy($uuid)
    {
        // Cari data produksi berdasarkan UUID
        $produksi = Produksi::where('uuid', $uuid)->firstOrFail();

        // Hapus data
        $produksi->delete();

        // Redirect ke halaman index
        return redirect()->route('produksi.index')->with('success', 'Produksi berhasil dihapus');
    }
}
