<?php

namespace App\Http\Controllers;

use App\Models\Sample_bulanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class Sample_bulananController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Sample_bulanan::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('plant', 'like', "%{$search}%")
            ->orWhere('sample_bulan', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.sample_bulanan.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.sample_bulanan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');

        $request->validate([
            'date'           => 'required|date',
            'sample_bulan'   => 'required',
            'plant'          => 'required',
            'sample_storage' => 'nullable|array',
            'sample'         => 'nullable|array',
            'catatan'        => 'nullable|string',
            'nama_warehouse' => 'nullable|string',
        ]);

        $data = $request->only(['date', 'sample_bulan', 'plant', 'catatan', 'nama_warehouse']);
        $data['username']         = $username;
        $data['status_warehouse'] = "1";
        $data['status_spv']       = "0";

        // Konversi sample ke JSON
        $data['sample_storage'] = json_encode($request->input('sample_storage', []), JSON_UNESCAPED_UNICODE);
        $data['sample'] = json_encode($request->input('sample', []), JSON_UNESCAPED_UNICODE);

        Sample_bulanan::create($data);

        return redirect()->route('sample_bulanan.index')
        ->with('success', 'Data Sample Bulanan RND berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $sample_bulanan = Sample_bulanan::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        $sampleStorage = !empty($sample_bulanan->sample_storage) ? json_decode($sample_bulanan->sample_storage, true) : [];
        $sampleData = !empty($sample_bulanan->sample) ? json_decode($sample_bulanan->sample, true) : [];

        return view('form.sample_bulanan.edit', compact('sample_bulanan', 'produks', 'sampleData', 'sampleStorage'));
    }

    public function update(Request $request, string $uuid)
    {
        $sample_bulanan = Sample_bulanan::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');

        $request->validate([
            'date'           => 'required|date',
            'sample_bulan'   => 'required|date',
            'plant'          => 'required',
            'sample_storage' => 'nullable|array',
            'sample'         => 'nullable|array',
            'catatan'        => 'nullable|string',
            'nama_warehouse' => 'nullable|string',
        ]);

        $sample_storage = $request->input('sample_storage', []);
        $sample = $request->input('sample', []);

        $data = [
            'date' => $request->date,
            'sample_bulan' => $request->sample_bulan,
            'plant' => $request->plant,
            'catatan' => $request->catatan,
            'nama_warehouse' => $request->nama_warehouse,
            'username_updated' => $username_updated,
            'sample_storage' => json_encode($sample_storage, JSON_UNESCAPED_UNICODE),
            'sample' => json_encode($sample, JSON_UNESCAPED_UNICODE),
        ];

        $sample_bulanan->update($data);

        return redirect()->route('sample_bulanan.index')->with('success', 'Data Sample Bulanan RND berhasil diperbarui');
    }


    public function destroy($uuid)
    {
        $sample_bulanan = Sample_bulanan::where('uuid', $uuid)->firstOrFail();
        $sample_bulanan->delete();

        return redirect()->route('sample_bulanan.index')
        ->with('success', 'Data Sample Bulanan RND berhasil dihapus');
    }
}
