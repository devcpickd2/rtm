<?php

namespace App\Http\Controllers;

use App\Models\Metal;
use App\Models\Produk;
use Illuminate\Http\Request;

class MetalController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Metal::query()
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

        return view('form.metal.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.metal.create', compact('produks'));
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

        Metal::create($data);

        return redirect()->route('metal.index')
        ->with('success', 'Data Pemeriksaan X RAY berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

    // Decode JSON menjadi array
        $pemeriksaanData = !empty($metal->pemeriksaan) ? json_decode($metal->pemeriksaan, true) : [];

        return view('form.metal.edit', compact('metal', 'produks', 'pemeriksaanData'));
    }

    public function update(Request $request, string $uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'no_program'  => 'required',
            'catatan'     => 'nullable|string',
            'pemeriksaan' => 'nullable|array',
        ]);

        $pemeriksaan = [];
        foreach ($request->pemeriksaan as $item) {
            $pemeriksaan[] = [
                'pukul' => $item['pukul'] ?? null,
                'fe' => $item['fe'] ?? 'Tidak Oke',
                'non_fe' => $item['non_fe'] ?? 'Tidak Oke',
                'sus_316' => $item['sus_316'] ?? 'Tidak Oke',
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

        $metal->update($data);

        return redirect()->route('metal.index')->with('success', 'Data Pemeriksaan X RAY berhasil diperbarui');
    }


    public function destroy($uuid)
    {
        $metal = Metal::where('uuid', $uuid)->firstOrFail();
        $metal->delete();

        return redirect()->route('metal.index')
        ->with('success', 'Data Pemeriksaan X RAY berhasil dihapus');
    }
}
