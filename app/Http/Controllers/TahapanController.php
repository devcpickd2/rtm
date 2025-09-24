<?php

namespace App\Http\Controllers;

use App\Models\Tahapan;
use App\Models\Produk;
use Illuminate\Http\Request;

class TahapanController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Tahapan::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('kode_produksi', 'like', "%{$search}%");
            });
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.tahapan.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.tahapan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date' => 'required|date',
            'shift' => 'required|in:1,2,3',
            'nama_produk' => 'required|string|max:255',
            'kode_produksi' => 'required|string|max:255',
            'filling_mulai' => 'nullable|date_format:H:i',
            'filling_selesai' => 'nullable|date_format:H:i',
            'waktu_iqf' => 'nullable|date_format:H:i',
            'waktu_sealer' => 'nullable|date_format:H:i',
            'waktu_xray' => 'nullable|date_format:H:i',
            'waktu_sticker' => 'nullable|date_format:H:i',
            'waktu_shrink' => 'nullable|date_format:H:i',
            'waktu_packing' => 'nullable|date_format:H:i',
            'waktu_cs' => 'nullable|date_format:H:i',
            'suhu_filling' => 'nullable|array',
            'suhu_filling.*.nama_bahan' => 'nullable|string|max:255',
            'suhu_filling.*.suhu' => 'nullable|numeric',
            'suhu_masuk_iqf' => 'nullable|numeric',
            'suhu_keluar_iqf' => 'nullable|numeric',
            'suhu_sealer' => 'nullable|numeric',
            'suhu_xray' => 'nullable|numeric',
            'suhu_sticker' => 'nullable|numeric',
            'suhu_shrink' => 'nullable|numeric',
            'downtime' => 'nullable|numeric',
            'suhu_cs' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only([
            'date','shift','nama_produk','kode_produksi','filling_mulai','filling_selesai',
            'waktu_iqf','waktu_sealer','waktu_xray','waktu_sticker','waktu_shrink',
            'waktu_packing','waktu_cs','suhu_masuk_iqf','suhu_keluar_iqf','suhu_sealer',
            'suhu_xray','suhu_sticker','suhu_shrink','downtime','suhu_cs','keterangan','catatan'
        ]);

        $data['username'] = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

    // Filter suhu_filling: hanya baris yang ada nama_bahan atau suhu
        $suhu_filling = $request->input('suhu_filling', []);
        $filtered = [];
        foreach ($suhu_filling as $item) {
            if (!empty($item['nama_bahan']) || !empty($item['suhu'])) {
                $filtered[] = $item;
            }
        }
        $data['suhu_filling'] = json_encode($filtered, JSON_UNESCAPED_UNICODE);

        Tahapan::create($data);

        return redirect()->route('tahapan.index')
        ->with('success', 'Data Pengecekan Suhu Produk Setiap Tahapan Proses berhasil disimpan');
    }


    public function edit($uuid)
    {
        $tahapan = Tahapan::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

    // Sudah array, tidak perlu json_decode
        $suhu_fillingData = $tahapan->suhu_filling ?? [];

        return view('form.tahapan.edit', compact('tahapan', 'produks', 'suhu_fillingData'));
    }


    public function update(Request $request, $uuid)
    {
        $tahapan = Tahapan::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username', 'Harnis');

        $validated = $request->validate([
            'date' => 'required|date',
            'shift' => 'required|in:1,2,3',
            'nama_produk' => 'required|string|max:255',
            'kode_produksi' => 'required|string|max:255',
            'filling_mulai' => 'nullable|date_format:H:i',
            'filling_selesai' => 'nullable|date_format:H:i',
            'waktu_iqf' => 'nullable|date_format:H:i',
            'waktu_sealer' => 'nullable|date_format:H:i',
            'waktu_xray' => 'nullable|date_format:H:i',
            'waktu_sticker' => 'nullable|date_format:H:i',
            'waktu_shrink' => 'nullable|date_format:H:i',
            'waktu_packing' => 'nullable|date_format:H:i',
            'waktu_cs' => 'nullable|date_format:H:i',
            'suhu_filling' => 'nullable|array',
            'suhu_filling.*.nama_bahan' => 'nullable|string|max:255',
            'suhu_filling.*.suhu' => 'nullable|numeric',
            'suhu_masuk_iqf' => 'nullable|numeric',
            'suhu_keluar_iqf' => 'nullable|numeric',
            'suhu_sealer' => 'nullable|numeric',
            'suhu_xray' => 'nullable|numeric',
            'suhu_sticker' => 'nullable|numeric',
            'suhu_shrink' => 'nullable|numeric',
            'downtime' => 'nullable|numeric',
            'suhu_cs' => 'nullable|numeric',
            'catatan' => 'nullable|string',
        ]);

    // Filter suhu_filling: hanya baris yang ada nama_bahan atau suhu
        $suhu_filling = $validated['suhu_filling'] ?? [];
        $filtered = [];
        foreach ($suhu_filling as $item) {
            if (!empty($item['nama_bahan']) || !empty($item['suhu'])) {
                $filtered[] = $item;
            }
        }
        $validated['suhu_filling'] = json_encode($filtered, JSON_UNESCAPED_UNICODE);

        $validated['username_updated'] = $username_updated;
        $validated['tgl_update_produksi'] = now();

        $tahapan->update($validated);

        return redirect()->route('tahapan.index')
        ->with('success', 'Data Pengecekan Suhu Produk Setiap Tahapan Proses berhasil diupdate.');
    }

    public function destroy(string $uuid)
    {
        $tahapan = Tahapan::where('uuid', $uuid)->firstOrFail();
        $tahapan->delete();

        return redirect()->route('tahapan.index')
        ->with('success', 'Data Pengecekan Suhu Produk Setiap Tahapan Proses berhasil dihapus');
    }
}
