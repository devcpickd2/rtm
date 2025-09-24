<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use App\Models\Produk;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Mesin::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('verif_mesin', 'like', "%{$search}%");
            });
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.mesin.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        // misal daftar mesin dari database
        $mesinList = ['Weigher Portioning', 'Weigher Filling', 'Weigher Cartoning', 'Topseal', 'Furukawa', 'Chingfong', 'IQF' ];

        $produks = Produk::all();
        return view('form.mesin.create', compact('produks', 'mesinList'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        // validasi
        $request->validate([
            'date' => 'required|date',
            'shift' => 'required|in:1,2,3',
            'nama_mesin.*' => 'nullable|string',
            'standar_setting.*' => 'nullable|string',
            'aktual.*' => 'nullable|string',
            'tindakan_perbaikan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // input array
        $nama_mesin       = $request->input('nama_mesin', []);
        $standar_setting  = $request->input('standar_setting', []);
        $aktual           = $request->input('aktual', []);

        // gabung array jadi json
        $verif_mesin = [];
        foreach ($nama_mesin as $i => $nm) {
            if (!empty($nm)) {
                $verif_mesin[] = [
                    'nama_mesin'       => $nm,
                    'standar_setting'  => $standar_setting[$i] ?? null,
                    'aktual'           => $aktual[$i] ?? null,
                ];
            }
        }

        // simpan data utama
        $data = [
            'date'               => $request->date,
            'shift'              => $request->shift,
            'username'           => $username,
            'nama_produksi'      => $nama_produksi,
            'status_produksi'    => '1',
            'status_spv'         => '0',
            'tindakan_perbaikan' => $request->tindakan_perbaikan,
            'keterangan'         => $request->keterangan,
            'catatan'            => $request->catatan,
            'verif_mesin'        => json_encode($verif_mesin, JSON_UNESCAPED_UNICODE),
        ];

        Mesin::create($data);

        return redirect()->route('mesin.index')
        ->with('success', 'Data Verifikasi Mesin berhasil disimpan');
    }

    public function edit($uuid)
    {
        $mesinList = ['Weigher Portioning', 'Weigher Filling', 'Weigher Cartoning', 'Topseal', 'Furukawa', 'Chingfong', 'IQF' ];
        $mesin = Mesin::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        // decode JSON untuk ditampilkan
        $verif_mesinData = json_decode($mesin->verif_mesin ?? '[]', true);

        return view('form.mesin.edit', compact('mesin', 'produks', 'verif_mesinData', 'mesinList'));
    }

    public function update(Request $request, $uuid)
    {
        $mesin = Mesin::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username', 'Harnis'); 

        // validasi basic
        $validated = $request->validate([
            'date' => 'required|date',
            'shift' => 'required|in:1,2,3',
            'tindakan_perbaikan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'nama_mesin.*' => 'nullable|string',
            'standar_setting.*' => 'nullable|string',
            'aktual.*' => 'nullable|string',
        ]);

        // input array
        $nama_mesin       = $request->input('nama_mesin', []);
        $standar_setting  = $request->input('standar_setting', []);
        $aktual           = $request->input('aktual', []);

        // gabung array jadi json
        $verif_mesin = [];
        foreach ($nama_mesin as $i => $nm) {
            if (!empty($nm)) {
                $verif_mesin[] = [
                    'nama_mesin'       => $nm,
                    'standar_setting'  => $standar_setting[$i] ?? null,
                    'aktual'           => $aktual[$i] ?? null,
                ];
            }
        }

        // masukkan ke validated
        $validated['verif_mesin']         = json_encode($verif_mesin, JSON_UNESCAPED_UNICODE);
        $validated['username_updated']    = $username_updated;
        $validated['tgl_update_produksi'] = now();

        // update data
        $mesin->update($validated);

        return redirect()->route('mesin.index')
        ->with('success', 'Data Verifikasi Mesin berhasil diupdate.');
    }

    public function destroy(string $uuid)
    {
        $mesin = Mesin::where('uuid', $uuid)->firstOrFail();
        $mesin->delete();

        return redirect()->route('mesin.index')
        ->with('success', 'Data Verifikasi Mesin berhasil dihapus');
    }
}
