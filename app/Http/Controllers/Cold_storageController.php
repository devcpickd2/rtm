<?php

namespace App\Http\Controllers;

use App\Models\Cold_storage;
use App\Models\Produk;
use Illuminate\Http\Request;

class Cold_storageController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Cold_storage::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('suhu_cs', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.cold_storage.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.cold_storage.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'pukul'       => 'required',
            'catatan'     => 'nullable|string',
            'nama_warehouse' => 'required',
            'suhu_cs'     => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'pukul', 'catatan', 'nama_warehouse']);
        $data['username']        = $username;
        $data['status_warehouse'] = "1";
        $data['status_spv']      = "0";

        // Konversi suhu_cs ke JSON
        $data['suhu_cs'] = json_encode($request->input('suhu_cs', []), JSON_UNESCAPED_UNICODE);

        Cold_storage::create($data);

        return redirect()->route('cold_storage.index')
        ->with('success', 'Data Pemantauan Suhu Produk di Cold Storage berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $cold_storage = Cold_storage::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        $suhuData = !empty($cold_storage->suhu_cs) ? json_decode($cold_storage->suhu_cs, true) : [];

        return view('form.cold_storage.edit', compact('cold_storage', 'produks', 'suhuData'));
    }

    public function update(Request $request, string $uuid)
    {
        $cold_storage = Cold_storage::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'pukul'       => 'required',
            'catatan'     => 'nullable|string',
            'nama_warehouse' => 'required',
            'suhu_cs'     => 'nullable|array',
        ]);

        $suhu_cs = $request->input('suhu_cs', []);

        $data = [
            'date' => $request->date,
            'shift' => $request->shift,
            'pukul' => $request->pukul,
            'catatan' => $request->catatan,
            'username_updated' => $username_updated,
            'nama_warehouse' => $request->nama_warehouse,
            'suhu_cs' => json_encode($suhu_cs, JSON_UNESCAPED_UNICODE),
        ];

        $cold_storage->update($data);

        return redirect()->route('cold_storage.index')->with('success', 'Data Pemantauan Suhu Produk di Cold Storage berhasil diperbarui');
    }


    public function destroy($uuid)
    {
        $cold_storage = Cold_storage::where('uuid', $uuid)->firstOrFail();
        $cold_storage->delete();

        return redirect()->route('cold_storage.index')
        ->with('success', 'Data Pemantauan Suhu Produk di Cold Storage berhasil dihapus');
    }
}
