<?php

namespace App\Http\Controllers;

use App\Models\Sortasi;
use Illuminate\Http\Request;

class SortasiController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Sortasi::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_bahan', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.sortasi.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.sortasi.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'nama_bahan' => 'required',
            'kode_produksi' => 'required',
            'jumlah_bahan' => 'nullable|string',
            'jumlah_sesuai' => 'nullable|string',
            'jumlah_tidak_sesuai' => 'nullable|string',
            'tindakan_koreksi'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift',
            'nama_bahan', 'kode_produksi', 'jumlah_bahan', 'jumlah_sesuai', 'jumlah_tidak_sesuai', 'tindakan_koreksi', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Sortasi::create($data);

        return redirect()->route('sortasi.index')->with('success', 'Data Sortasi Bahan Baku yang Tidak Sesuai berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $sortasi = Sortasi::where('uuid', $uuid)->firstOrFail();
        return view('form.sortasi.edit', compact('sortasi'));
    }

    public function update(Request $request, string $uuid)
    {
        $sortasi = Sortasi::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
         'date'  => 'required|date',
         'shift' => 'required',
         'nama_bahan' => 'required',
         'kode_produksi' => 'required',
         'jumlah_bahan' => 'nullable|string',
         'jumlah_sesuai' => 'nullable|string',
         'jumlah_tidak_sesuai' => 'nullable|string',
         'tindakan_koreksi'   => 'nullable|string',
         'catatan'    => 'nullable|string',
     ]);

        $data = $request->only([
          'date', 'shift',
          'nama_bahan', 'kode_produksi', 'jumlah_bahan', 'jumlah_sesuai', 'jumlah_tidak_sesuai', 'tindakan_koreksi', 'catatan'
      ]);
        
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $sortasi->update($data);

        return redirect()->route('sortasi.index')->with('success', 'Data Sortasi Bahan Baku yang Tidak Sesuai berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $sortasi = Sortasi::where('uuid', $uuid)->firstOrFail();
        $sortasi->delete();

        return redirect()->route('sortasi.index')->with('success', 'Data Sortasi Bahan Baku yang Tidak Sesuai berhasil dihapus');
    }
}
