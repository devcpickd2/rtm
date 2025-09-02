<?php

namespace App\Http\Controllers;

use App\Models\Thawing;
use Illuminate\Http\Request;

class ThawingController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Thawing::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('jenis_produk', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.thawing.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.thawing.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'kondisi_ruangan' => 'required|string',
            'jenis_produk' => 'required|string',
            'kode_produksi' => 'required|string',
            'jumlah' => 'required',
            'kondisi_produk' => 'nullable|string',
            'keterangan_kondisi' => 'nullable|string',
            'suhu_ruangan'   => 'nullable|string',
            'mulai_thawing'   => 'required',
            'selesai_thawing'   => 'required',
            'kondisi_produk_setelah'   => 'nullable|string',
            'keterangan_kondisi_setelah'   => 'nullable|string',
            'jumlah_setelah'   => 'required',
            'suhu_produk'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'kondisi_ruangan',
            'jenis_produk', 'kode_produksi', 'jumlah', 'kondisi_produk', 'keterangan_kondisi', 'suhu_ruangan', 'mulai_thawing', 'selesai_thawing',
            'kondisi_produk_setelah', 'keterangan_kondisi_setelah', 'jumlah_setelah', 'suhu_produk', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Thawing::create($data);

        return redirect()->route('thawing.index')->with('success', 'Data Pemeriksaan Proses Thawing berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $thawing = Thawing::where('uuid', $uuid)->firstOrFail();
        return view('form.thawing.edit', compact('thawing'));
    }

    public function update(Request $request, string $uuid)
    {
        $thawing = Thawing::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
           'date'  => 'required|date',
           'kondisi_ruangan' => 'required|string',
           'jenis_produk' => 'required|string',
           'kode_produksi' => 'required|string',
           'jumlah' => 'required',
           'kondisi_produk' => 'nullable|string',
           'keterangan_kondisi' => 'nullable|string',
           'suhu_ruangan'   => 'nullable|string',
           'mulai_thawing'   => 'required',
           'selesai_thawing'   => 'required',
           'kondisi_produk_setelah'   => 'nullable|string',
           'keterangan_kondisi_setelah'   => 'nullable|string',
           'jumlah_setelah'   => 'required',
           'suhu_produk'   => 'nullable|string',
           'catatan'    => 'nullable|string',
       ]);

        $data = $request->only([
            'date', 'kondisi_ruangan',
            'jenis_produk', 'kode_produksi', 'jumlah', 'kondisi_produk', 'keterangan_kondisi', 'suhu_ruangan', 'mulai_thawing', 'selesai_thawing',
            'kondisi_produk_setelah', 'keterangan_kondisi_setelah', 'jumlah_setelah', 'suhu_produk', 'catatan'
        ]);
        
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $thawing->update($data);

        return redirect()->route('thawing.index')->with('success', 'Data Pemeriksaan Proses Thawing berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $thawing = Thawing::where('uuid', $uuid)->firstOrFail();
        $thawing->delete();

        return redirect()->route('thawing.index')->with('success', 'Data Pemeriksaan Proses Thawing berhasil dihapus');
    }
}
