<?php

namespace App\Http\Controllers;

use App\Models\Pemusnahan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PemusnahanController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Pemusnahan::query()
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

        return view('form.pemusnahan.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.pemusnahan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');

        $request->validate([
            'date'  => 'required|date',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'expired_date'  => 'required|date',
            'analisis' => 'nullable|string',
            'keterangan'   => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'nama_produk', 'kode_produksi', 'expired_date', 'analisis', 'keterangan'
        ]);

        $data['username']      = $username;
        $data['status_spv'] = "0";

        Pemusnahan::create($data);

        return redirect()->route('pemusnahan.index')->with('success', 'Data Pemusnahan Barang/Produk berhasil disimpan');
    }

    public function edit(string $uuid)
    {
       $produks = Produk::all();
       $pemusnahan = pemusnahan::where('uuid', $uuid)->firstOrFail();
       return view('form.pemusnahan.edit', compact('pemusnahan', 'produks'));
   }

   public function update(Request $request, string $uuid)
   {
    $pemusnahan = Pemusnahan::where('uuid', $uuid)->firstOrFail();

    $username_updated = session('username_updated', 'Harnis');

    $request->validate([
        'date'  => 'required|date',
        'nama_produk' => 'required',
        'kode_produksi' => 'required',
        'expired_date'  => 'required|date',
        'analisis' => 'nullable|string',
        'keterangan'   => 'nullable|string',
    ]);

    $data = $request->only([
        'date', 'nama_produk', 'kode_produksi', 'expired_date', 'analisis', 'keterangan'
    ]);

    $data['username_updated'] = $username_updated;

    $pemusnahan->update($data);

    return redirect()->route('pemusnahan.index')->with('success', 'Data Pemusnahan Barang/Produk berhasil diperbarui');
}

public function destroy($uuid)
{
    $pemusnahan = Pemusnahan::where('uuid', $uuid)->firstOrFail();
    $pemusnahan->delete();

    return redirect()->route('pemusnahan.index')->with('success', 'Data Pemusnahan Barang/Produk berhasil dihapus');
}
}
