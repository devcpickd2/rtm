<?php

namespace App\Http\Controllers;

use App\Models\Gramasi;
use App\Models\Produk;
use Illuminate\Http\Request;

class GramasiController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Gramasi::query()
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

        return view('form.gramasi.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.gramasi.create', compact('produks'));
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

            'jenis_topping.*' => 'nullable|string|max:255',
            'standar.*' => 'nullable|numeric',
            'gramasi_1.*' => 'nullable|numeric',
            'gramasi_2.*' => 'nullable|numeric',
            'gramasi_3.*' => 'nullable|numeric',
            'pukul_1' => 'nullable|date_format:H:i',
            'pukul_2' => 'nullable|date_format:H:i',
            'pukul_3' => 'nullable|date_format:H:i',

            'tindakan_koreksi' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only(['date','shift','nama_produk','kode_produksi','tindakan_koreksi','catatan']);
        $data['username'] = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        // Ambil input
        $jenis   = $request->input('jenis_topping', []);
        $standar = $request->input('standar', []);
        $gramasi1 = $request->input('gramasi_1', []);
        $gramasi2 = $request->input('gramasi_2', []);
        $gramasi3 = $request->input('gramasi_3', []);
        $pukul1 = $request->input('pukul_1');
        $pukul2 = $request->input('pukul_2');
        $pukul3 = $request->input('pukul_3');

        // Buat array gramasi_topping hanya dari baris yang diisi
        $gramasi_topping = [];
        foreach ($jenis as $i => $j) {
            if (!empty($j)) {
                $gramasi_topping[] = [
                    'jenis_topping' => $j,
                    'standar'       => $standar[$i] ?? null,
                    'pukul_1'       => $pukul1,
                    'gramasi_1'     => $gramasi1[$i] ?? null,
                    'pukul_2'       => $pukul2,
                    'gramasi_2'     => $gramasi2[$i] ?? null,
                    'pukul_3'       => $pukul3,
                    'gramasi_3'     => $gramasi3[$i] ?? null,
                ];
            }
        }

        $data['gramasi_topping'] = json_encode($gramasi_topping, JSON_UNESCAPED_UNICODE);

        Gramasi::create($data);

        return redirect()->route('gramasi.index')
            ->with('success', 'Data Verifikasi Gramasi Topping berhasil disimpan');
    }

    public function edit($uuid)
    {
        $gramasi = Gramasi::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        // Decode JSON agar bisa ditampilkan di input
        $gramasi_toppingData = json_decode($gramasi->gramasi_topping ?? '[]', true);

        return view('form.gramasi.edit', compact('gramasi', 'produks', 'gramasi_toppingData'));
    }

    public function update(Request $request, $uuid)
    {
        $gramasi = Gramasi::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username', 'Harnis'); 

        $validated = $request->validate([
            'date' => 'required|date',
            'shift' => 'required|in:1,2,3',
            'nama_produk' => 'required|string|max:255',
            'kode_produksi' => 'required|string|max:255',

            'jenis_topping.*' => 'nullable|string|max:255',
            'standar.*' => 'nullable|numeric',
            'gramasi_1.*' => 'nullable|numeric',
            'gramasi_2.*' => 'nullable|numeric',
            'gramasi_3.*' => 'nullable|numeric',
            'pukul_1' => 'nullable|date_format:H:i',
            'pukul_2' => 'nullable|date_format:H:i',
            'pukul_3' => 'nullable|date_format:H:i',

            'tindakan_koreksi' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // Ambil input
        $jenis   = $request->input('jenis_topping', []);
        $standar = $request->input('standar', []);
        $gramasi1 = $request->input('gramasi_1', []);
        $gramasi2 = $request->input('gramasi_2', []);
        $gramasi3 = $request->input('gramasi_3', []);
        $pukul1 = $request->input('pukul_1');
        $pukul2 = $request->input('pukul_2');
        $pukul3 = $request->input('pukul_3');

        $gramasi_topping = [];
        foreach ($jenis as $i => $j) {
            if (!empty($j)) {
                $gramasi_topping[] = [
                    'jenis_topping' => $j,
                    'standar'       => $standar[$i] ?? null,
                    'pukul_1'       => $pukul1,
                    'gramasi_1'     => $gramasi1[$i] ?? null,
                    'pukul_2'       => $pukul2,
                    'gramasi_2'     => $gramasi2[$i] ?? null,
                    'pukul_3'       => $pukul3,
                    'gramasi_3'     => $gramasi3[$i] ?? null,
                ];
            }
        }

        $validated['gramasi_topping'] = json_encode($gramasi_topping, JSON_UNESCAPED_UNICODE);
        $validated['username_updated'] = $username_updated;
        $validated['tgl_update_produksi'] = now();

        $gramasi->update($validated);

        return redirect()->route('gramasi.index')
            ->with('success', 'Data Verifikasi Gramasi Topping berhasil diupdate.');
    }

    public function destroy(string $uuid)
    {
        $gramasi = Gramasi::where('uuid', $uuid)->firstOrFail();
        $gramasi->delete();

        return redirect()->route('gramasi.index')
            ->with('success', 'Data Verifikasi Gramasi Topping berhasil dihapus');
    }
}
