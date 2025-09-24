<?php

namespace App\Http\Controllers;

use App\Models\Sample_retain;
use App\Models\Produk;
use Illuminate\Http\Request;

class Sample_retainController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Sample_retain::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.sample_retain.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.sample_retain.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');

        $request->validate([
            'nama_produk'    => 'required',
            'kode_produksi'  => 'required',
            'analisa'        => 'nullable|array',
        ]);

        $data = $request->only(['nama_produk', 'kode_produksi']);
        $data['username']         = $username;
        $data['status_spv']       = "0";

        $data['analisa'] = json_encode($request->input('analisa', []), JSON_UNESCAPED_UNICODE);

        Sample_retain::create($data);

        return redirect()->route('sample_retain.index')
        ->with('success', 'Data Pemeriksaan Sample Retain berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $sample_retain = Sample_retain::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        $sampleData = !empty($sample_retain->analisa) ? json_decode($sample_retain->analisa, true) : [];

        return view('form.sample_retain.edit', compact('sample_retain', 'produks', 'sampleData'));
    }

    public function update(Request $request, string $uuid)
    {
        $sample_retain = Sample_retain::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');

        $request->validate([
            'nama_produk'    => 'required',
            'kode_produksi'  => 'required',
            'analisa'        => 'nullable|array',
        ]);

        $analisa = $request->input('analisa', []);

        $data = [
            'nama_produk' => $request->nama_produk,
            'kode_produksi' => $request->kode_produksi,
            'username_updated' => $username_updated,
            'analisa' => json_encode($analisa, JSON_UNESCAPED_UNICODE),
        ];

        $sample_retain->update($data);

        return redirect()->route('sample_retain.index')->with('success', 'Data Pemeriksaan Sample Retain berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $sample_retain = Sample_retain::where('uuid', $uuid)->firstOrFail();
        $sample_retain->delete();

        return redirect()->route('sample_retain.index')
        ->with('success', 'Data Pemeriksaan Sample Retain berhasil dihapus');
    }
}
