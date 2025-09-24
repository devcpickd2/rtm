<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Produk;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Disposisi::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.disposisi.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.disposisi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'jumlah' => 'nullable|numeric',
            'ketidaksesuaian' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'keterangan'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift',
            'nama_produk', 'kode_produksi', 'jumlah', 'ketidaksesuaian', 'tindakan',
            'keterangan', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Disposisi::create($data);

        return redirect()->route('disposisi.index')->with('success', 'Data Pemeriksaan Disposisi Produk tidak Sesuai berhasil disimpan');
    }

    public function edit(string $uuid)
    {
       $produks = Produk::all();
       $disposisi = Disposisi::where('uuid', $uuid)->firstOrFail();
       return view('form.disposisi.edit', compact('disposisi', 'produks'));
   }

   public function update(Request $request, string $uuid)
   {
    $disposisi = Disposisi::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
    $username_updated = session('username_updated', 'Harnis');
    $nama_produksi = session('nama_produksi', 'Produksi RTM');

    $request->validate([
      'date'  => 'required|date',
      'shift' => 'required',
      'nama_produk' => 'required',
      'kode_produksi' => 'required',
      'jumlah' => 'nullable|numeric',
      'ketidaksesuaian' => 'nullable|string',
      'tindakan' => 'nullable|string',
      'keterangan'   => 'nullable|string',
      'catatan'    => 'nullable|string',
  ]);

    $data = $request->only([
        'date', 'shift',
        'nama_produk', 'kode_produksi', 'jumlah', 'ketidaksesuaian', 'tindakan',
        'keterangan', 'catatan'
    ]);

    $data['username_updated'] = $username_updated;
    $data['nama_produksi'] = $nama_produksi;

    $disposisi->update($data);

    return redirect()->route('disposisi.index')->with('success', 'Data Pemeriksaan Disposisi Produk tidak Sesuai berhasil diperbarui');
}

public function destroy($uuid)
{
    $disposisi = Disposisi::where('uuid', $uuid)->firstOrFail();
    $disposisi->delete();

    return redirect()->route('disposisi.index')->with('success', 'Data Pemeriksaan Disposisi Produk tidak Sesuai berhasil dihapus');
}
}
