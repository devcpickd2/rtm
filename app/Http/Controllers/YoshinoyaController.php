<?php

namespace App\Http\Controllers;

use App\Models\Yoshinoya;
use Illuminate\Http\Request;

class YoshinoyaController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Yoshinoya::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%")
            ->orWhere('saus', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.yoshinoya.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.yoshinoya.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'saus' => 'required',
            'kode_produksi' => 'required',
            'suhu_pengukuran' => 'required',
            'brix' => 'nullable|string',
            'salt'   => 'nullable|string',
            'visco'   => 'nullable|string',
            'brookfield_sebelum'   => 'nullable|string',
            'brookfield_frozen'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift', 'saus', 'kode_produksi', 'suhu_pengukuran', 'brix', 'salt', 'visco', 'brookfield_sebelum', 'brookfield_frozen', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Yoshinoya::create($data);

        return redirect()->route('yoshinoya.index')->with('success', 'Data Parameter Produk Saus Yoshinoya berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $yoshinoya = Yoshinoya::where('uuid', $uuid)->firstOrFail();
        return view('form.yoshinoya.edit', compact('yoshinoya'));
    }

    public function update(Request $request, string $uuid)
    {
        $yoshinoya = Yoshinoya::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'saus' => 'required',
            'kode_produksi' => 'required',
            'suhu_pengukuran' => 'required',
            'brix' => 'nullable|string',
            'salt'   => 'nullable|string',
            'visco'   => 'nullable|string',
            'brookfield_sebelum'   => 'nullable|string',
            'brookfield_frozen'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift', 'saus', 'kode_produksi', 'suhu_pengukuran', 'brix', 'salt', 'visco', 'brookfield_sebelum', 'brookfield_frozen', 'catatan'
        ]);
        
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $yoshinoya->update($data);

        return redirect()->route('yoshinoya.index')->with('success', 'Data Parameter Produk Saus Yoshinoya berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $yoshinoya = Yoshinoya::where('uuid', $uuid)->firstOrFail();
        $yoshinoya->delete();

        return redirect()->route('yoshinoya.index')->with('success', 'Data Parameter Produk Saus Yoshinoya berhasil dihapus');
    }
}
