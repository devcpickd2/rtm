<?php

namespace App\Http\Controllers;

use App\Models\Xray;
use App\Models\Produk;
use Illuminate\Http\Request;

class XrayController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Xray::query()
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

        return view('form.xray.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.xray.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'no_program' => 'required',
            'catatan'     => 'nullable|string',
            'pemeriksaan'      => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_produk', 'kode_produksi', 'no_program', 'catatan']);
        $data['username']        = $username;
        $data['nama_produksi']   = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv']      = "0";

        // Konversi pemeriksaan ke JSON
        $data['pemeriksaan'] = json_encode($request->input('pemeriksaan', []), JSON_UNESCAPED_UNICODE);

        Xray::create($data);

        return redirect()->route('xray.index')
        ->with('success', 'Data Pemeriksaan X RAY berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $xray = Xray::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

    // Decode JSON menjadi array
        $pemeriksaanData = !empty($xray->pemeriksaan) ? json_decode($xray->pemeriksaan, true) : [];

        return view('form.xray.edit', compact('xray', 'produks', 'pemeriksaanData'));
    }

    public function update(Request $request, string $uuid)
    {
        $xray = Xray::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'no_program' => 'required',
            'catatan'     => 'nullable|string',
            'pemeriksaan' => 'nullable|array',
        ]);

        $pemeriksaan = [];
        foreach ($request->pemeriksaan as $item) {
            $pemeriksaan[] = [
                'pukul' => $item['pukul'] ?? null,
                'glass_ball' => $item['glass_ball'] ?? null,
                'glass_ball_status' => $item['glass_ball_status'] ?? 'Tidak Oke',
                'ceramic' => $item['ceramic'] ?? null,
                'ceramic_status' => $item['ceramic_status'] ?? 'Tidak Oke',
                'sus_wire' => $item['sus_wire'] ?? null,
                'sus_wire_status' => $item['sus_wire_status'] ?? 'Tidak Oke',
                'sus_ball' => $item['sus_ball'] ?? null,
                'sus_ball_status' => $item['sus_ball_status'] ?? 'Tidak Oke',
                'keterangan' => $item['keterangan'] ?? null,
                'tindakan_koreksi' => $item['tindakan_koreksi'] ?? null,
            ];
        }

        $data = [
            'date' => $request->date,
            'shift' => $request->shift,
            'nama_produk' => $request->nama_produk,
            'kode_produksi' => $request->kode_produksi,
            'no_program' => $request->no_program,
            'catatan' => $request->catatan,
            'username_updated' => $username_updated,
            'nama_produksi' => $nama_produksi,
            'pemeriksaan' => json_encode($pemeriksaan, JSON_UNESCAPED_UNICODE),
        ];

        $xray->update($data);

        return redirect()->route('xray.index')->with('success', 'Data Pemeriksaan X RAY berhasil diperbarui');
    }


    public function destroy($uuid)
    {
        $xray = Xray::where('uuid', $uuid)->firstOrFail();
        $xray->delete();

        return redirect()->route('xray.index')
        ->with('success', 'Data Pemeriksaan X RAY berhasil dihapus');
    }
}
