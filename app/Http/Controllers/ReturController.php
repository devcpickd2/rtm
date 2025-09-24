<?php

namespace App\Http\Controllers;

use App\Models\Retur;
use App\Models\Produk;
use Illuminate\Http\Request;

class ReturController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Retur::query()
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

        return view('form.retur.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.retur.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'no_mobil' => 'nullable|string',
            'nama_supir' => 'nullable|string',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'expired_date' => 'nullable|date',
            'jumlah' => 'nullable|integer',
            'bocor' => 'nullable|string',
            'isi_kurang' => 'nullable|string',
            'lainnya' => 'nullable|string',
            'keterangan'   => 'nullable|string',
            'catatan'    => 'nullable|string',
            'nama_warehouse' => 'required',
        ]);

        $data = $request->only([
            'date', 'shift', 'no_mobil', 'nama_supir',
            'nama_produk', 'kode_produksi', 'expired_date', 'jumlah', 'bocor', 'isi_kurang', 'lainnya',
            'keterangan', 'catatan', 'nama_warehouse'
        ]);

        $data['username']      = $username;
        $data['status_warehouse'] = "1";
        $data['status_spv'] = "0";

        Retur::create($data);

        return redirect()->route('retur.index')->with('success', 'Data Pemeriksaan Produk Retur berhasil disimpan');
    }

    public function edit(string $uuid)
    {
       $produks = Produk::all();
       $retur = Retur::where('uuid', $uuid)->firstOrFail();
       return view('form.retur.edit', compact('retur', 'produks'));
   }

   public function update(Request $request, string $uuid)
   {
    $retur = Retur::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
    $username_updated = session('username_updated', 'Harnis');

    $request->validate([
        'date'  => 'required|date',
        'shift' => 'required',
        'no_mobil' => 'nullable|string',
        'nama_supir' => 'nullable|string',
        'nama_produk' => 'required',
        'kode_produksi' => 'required',
        'expired_date' => 'nullable|date',
        'jumlah' => 'nullable|integer',
        'bocor' => 'nullable|string',
        'isi_kurang' => 'nullable|string',
        'lainnya' => 'nullable|string',
        'keterangan'   => 'nullable|string',
        'catatan'    => 'nullable|string',
        'nama_warehouse' => 'required',
    ]);

    $data = $request->only([
        'date', 'shift', 'no_mobil', 'nama_supir',
        'nama_produk', 'kode_produksi', 'expired_date', 'jumlah', 'bocor', 'isi_kurang', 'lainnya',
        'keterangan', 'catatan', 'nama_warehouse'
    ]);

    $data['username_updated'] = $username_updated;

    $retur->update($data);

    return redirect()->route('retur.index')->with('success', 'Data Pemeriksaan Produk Retur berhasil diperbarui');
}

public function destroy($uuid)
{
    $retur = Retur::where('uuid', $uuid)->firstOrFail();
    $retur->delete();

    return redirect()->route('retur.index')->with('success', 'Data Pemeriksaan Produk Retur berhasil dihapus');
}
}
