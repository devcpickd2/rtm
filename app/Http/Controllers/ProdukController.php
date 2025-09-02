<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; 
// Import model Produk agar bisa digunakan di controller

class ProdukController extends Controller
{
    // Menampilkan semua data produk
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produk = \App\Models\Produk::query()
        ->when($search, function($query, $search) {
            $query->where('nama_produk', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10) // 10 item per halaman
        ->withQueryString(); // agar search tetap tersimpan saat pindah halaman

        return view('produk.index', compact('produk'));
    }

    // Tampilkan form create
    public function create()
    {
        // Load view form tambah produk
        return view('produk.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        // Validasi input agar produk wajib diisi dan maksimal 255 karakter
        $request->validate([
            'nama_produk' => 'required|string|max:255'
        ]);

        // Ambil username dari session, jika tidak ada gunakan default 'putri'
        $username = session('username', 'putri');

        // Simpan data ke tabel produk
        Produk::create([
            'username' => $username,
            'nama_produk' => $request->nama_produk
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tampilkan form edit berdasarkan UUID
    public function edit($uuid)
    {
        // Cari data produk berdasarkan UUID. Jika tidak ada, tampilkan error 404
        $produk = Produk::where('uuid', $uuid)->firstOrFail();

        // Kirim data ke view edit
        return view('produk.edit', compact('produk'));
    }

    // Update data produk berdasarkan UUID
    public function update(Request $request, $uuid)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255'
        ]);

        // Cari produk berdasarkan UUID. Jika tidak ketemu, tampilkan 404
        $produk = Produk::where('uuid', $uuid)->firstOrFail();

        // Update kolom produk saja
        $produk->update([
            'nama_produk' => $request->nama_produk
        ]);

        // Redirect ke halaman index
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }

    // Hapus data produk berdasarkan UUID
    public function destroy($uuid)
    {
        // Cari data produk berdasarkan UUID
        $produk = Produk::where('uuid', $uuid)->firstOrFail();

        // Hapus data
        $produk->delete();

        // Redirect ke halaman index
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
