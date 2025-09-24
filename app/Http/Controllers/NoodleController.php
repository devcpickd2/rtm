<?php

namespace App\Http\Controllers;

use App\Models\Noodle;
use App\Models\Produk;
use Illuminate\Http\Request;

class NoodleController extends Controller{
    
   public function index(Request $request)
   {
    $search     = $request->input('search');
    $start_date = $request->input('start_date');
    $end_date   = $request->input('end_date');

    // Query pencarian + filter tanggal
    $data = Noodle::query()
    ->when($search, function ($query) use ($search) {
        $query->where('username', 'like', "%{$search}%")
        ->orWhere('nama_produk', 'like', "%{$search}%")
                ->orWhere('mixing', 'like', "%{$search}%"); // pakai mixing
            })
    ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
        $query->whereBetween('date', [$start_date, $end_date]);
    })
    ->orderBy('date', 'desc')
    ->orderBy('created_at', 'desc')
    ->paginate(10)
    ->appends($request->all());

    // ✅ decode kolom mixing supaya Blade gak ribet
    foreach ($data as $item) {
        $decoded = [];

        // Kalau field masih string JSON → decode
        if (is_string($item->mixing)) {
            $decoded = json_decode($item->mixing, true);
        } elseif (is_array($item->mixing)) {
            // Kalau sudah array → langsung pakai
            $decoded = $item->mixing;
        }

        // Pastikan array supaya Blade gak error
        $item->mixing_decoded = is_array($decoded) ? $decoded : [];
    }

    // ✅ return ke view
    return view('form.noodle.index', [
        'data'       => $data,
        'search'     => $search,
        'start_date' => $start_date,
        'end_date'   => $end_date,
    ]);
}


public function create()
{
    $produks = Produk::all();
    return view('form.noodle.create', compact('produks'));
}

public function store(Request $request)
{
    $username      = session('username', 'Putri');
    $nama_produksi = session('nama_produksi', 'Produksi RTM');

    $data = $request->validate([
        'date'        => 'required|date',
        'shift'       => 'required',
        'nama_produk' => 'required',
        'catatan'     => 'nullable|string',

        'mixing'      => 'nullable|array',
        'mixing.*.nama_produk'   => 'nullable|string',
        'mixing.*.kode_produksi' => 'nullable|string',
        'mixing.*.bahan_utama'   => 'nullable|string',
        'mixing.*.kode_bahan'    => 'nullable|string',
        'mixing.*.berat_bahan'   => 'nullable|string',

        // array bahan lain
        'mixing.*.bahan_lain'     => 'nullable|array',
        'mixing.*.waktu_proses'   => 'nullable|array',
        'mixing.*.vacuum'         => 'nullable|array',
        'mixing.*.suhu_adonan'    => 'nullable|array',

        // array aging
        'mixing.*.waktu_aging'     => 'nullable|array',
        'mixing.*.rh_aging'        => 'nullable|array',
        'mixing.*.suhu_ruang_aging'=> 'nullable|array',

        // rolling
        'mixing.*.tebal_rolling'        => 'nullable|array',
        // cutting
        'mixing.*.sampling_cutiing'     => 'nullable|array',
        // boiling
        'mixing.*.suhu_setting_boiling' => 'nullable|string',
        'mixing.*.suhu_actual_boiling'  => 'nullable|array',
        'mixing.*.waktu_boiling'        => 'nullable|string',
        // washing
        'mixing.*.suhu_setting_washing' => 'nullable|string',
        'mixing.*.suhu_actual_washing'  => 'nullable|array',
        'mixing.*.waktu_washing'        => 'nullable|string',
        // cooling shock
        'mixing.*.suhu_setting_cooling' => 'nullable|string',
        'mixing.*.suhu_actual_cooling'  => 'nullable|array',
        'mixing.*.waktu_cooling'        => 'nullable|string',

        // lama proses
        'mixing.*.mulai'         => 'nullable|string',
        'mixing.*.selesai'       => 'nullable|string',

        // sensori
        'mixing.*.suhu_akhir'   => 'nullable|array',
        'mixing.*.suhu_after'   => 'nullable|array',
        'mixing.*.rasa'         => 'nullable|array',
        'mixing.*.kekenyalan'   => 'nullable|array',
        'mixing.*.warna'        => 'nullable|array',
    ]);

    // Filter null level atas
    $data = array_filter($data, fn($v) => !is_null($v));

    // Filter mixing & bahan_lain
    if (!empty($data['mixing']) && is_array($data['mixing'])) {
        $filteredMixing = [];

        foreach ($data['mixing'] as $mix) {
            // filter bahan_lain spesifik
            if (!empty($mix['bahan_lain']) && is_array($mix['bahan_lain'])) {
                $filteredBahanLain = [];
                foreach ($mix['bahan_lain'] as $bl) {
                    if (
                        !empty($bl['nama_bahan']) ||
                        !empty($bl['kode_bahan_lain']) ||
                        !empty($bl['berat_bahan'])
                    ) {
                        $filteredBahanLain[] = $bl;
                    }
                }
                $mix['bahan_lain'] = $filteredBahanLain;
            }

            // filter null/array kosong lain
            $clean = array_filter($mix, function ($v) {
                if (is_array($v)) {
                    return !empty(array_filter($v));
                }
                return !is_null($v) && $v !== '';
            });

            if (!empty($clean)) {
                $filteredMixing[] = $clean;
            }
        }

        $data['mixing'] = $filteredMixing;
    }

    $data['username']        = $username;
    $data['nama_produksi']   = $nama_produksi;
    $data['status_produksi'] = "1";
    $data['status_spv']      = "0";

    Noodle::create($data);

    return redirect()->route('noodle.index')
    ->with('success', 'Data Pemeriksaan Pemasakan Noodle berhasil disimpan');
}


public function edit($uuid)
{
    $noodle = Noodle::where('uuid', $uuid)->firstOrFail();
    $produks = Produk::all();

    if (is_array($noodle->mixing)) {
        $mixing = $noodle->mixing;
    } else {
        $mixing = json_decode($noodle->mixing, true) ?? [];
    }

    return view('form.noodle.edit', compact('noodle', 'produks', 'mixing'));
}

public function update(Request $request, $uuid)
{
    $noodle = Noodle::where('uuid', $uuid)->firstOrFail();
    $username_updated = session('username_updated', 'Harnis');
    $nama_produksi    = session('nama_produksi', 'Produksi RTM');

    $data = $request->validate([
        'date'        => 'required|date',
        'shift'       => 'required',
        'nama_produk' => 'required',
        'catatan'     => 'nullable|string',

        'mixing'      => 'nullable|array',
        'mixing.*.nama_produk'   => 'nullable|string',
        'mixing.*.kode_produksi' => 'nullable|string',
        'mixing.*.bahan_utama'   => 'nullable|string',
        'mixing.*.kode_bahan'    => 'nullable|string',
        'mixing.*.berat_bahan'   => 'nullable|string',

        'mixing.*.bahan_lain'     => 'nullable|array',
        'mixing.*.waktu_proses'   => 'nullable|array',
        'mixing.*.vacuum'         => 'nullable|array',
        'mixing.*.suhu_adonan'    => 'nullable|array',
        'mixing.*.waktu_aging'     => 'nullable|array',
        'mixing.*.rh_aging'        => 'nullable|array',
        'mixing.*.suhu_ruang_aging'=> 'nullable|array',

        'mixing.*.tebal_rolling'        => 'nullable|array',
        'mixing.*.sampling_cutiing'     => 'nullable|array',

        'mixing.*.suhu_setting_boiling' => 'nullable|string',
        'mixing.*.suhu_actual_boiling'  => 'nullable|array',
        'mixing.*.waktu_boiling'        => 'nullable|string',

        'mixing.*.suhu_setting_washing' => 'nullable|string',
        'mixing.*.suhu_actual_washing'  => 'nullable|array',
        'mixing.*.waktu_washing'        => 'nullable|string',

        'mixing.*.suhu_setting_cooling' => 'nullable|string',
        'mixing.*.suhu_actual_cooling'  => 'nullable|array',
        'mixing.*.waktu_cooling'        => 'nullable|string',

        'mixing.*.mulai'         => 'nullable|string',
        'mixing.*.selesai'       => 'nullable|string',

        'mixing.*.suhu_akhir'   => 'nullable|array',
        'mixing.*.suhu_after'   => 'nullable|array',
        'mixing.*.rasa'         => 'nullable|array',
        'mixing.*.kekenyalan'   => 'nullable|array',
        'mixing.*.warna'        => 'nullable|array',
    ]);

    // Filter null level atas
    $data = array_filter($data, fn($v) => !is_null($v));

    // Filter mixing & bahan_lain
    if (!empty($data['mixing']) && is_array($data['mixing'])) {
        $filteredMixing = [];

        foreach ($data['mixing'] as $mix) {
            // filter bahan_lain spesifik
            if (!empty($mix['bahan_lain']) && is_array($mix['bahan_lain'])) {
                $filteredBahanLain = [];
                foreach ($mix['bahan_lain'] as $bl) {
                    if (
                        !empty($bl['nama_bahan']) ||
                        !empty($bl['kode_bahan_lain']) ||
                        !empty($bl['berat_bahan'])
                    ) {
                        $filteredBahanLain[] = $bl;
                    }
                }
                $mix['bahan_lain'] = $filteredBahanLain;
            }

            // filter null/array kosong lain
            $clean = array_filter($mix, function ($v) {
                if (is_array($v)) {
                    return !empty(array_filter($v));
                }
                return !is_null($v) && $v !== '';
            });

            if (!empty($clean)) {
                $filteredMixing[] = $clean;
            }
        }

        $data['mixing'] = $filteredMixing;
    }

    $data['username_updated'] = $username_updated;
    $data['nama_produksi']    = $nama_produksi;

    $noodle->update($data);

    return redirect()->route('noodle.index')
    ->with('success', 'Data Pemeriksaan Pemasakan noodle berhasil diperbarui');
}


public function destroy($uuid)
{
    $noodle = Noodle::where('uuid', $uuid)->firstOrFail();
    $noodle->delete();

    return redirect()->route('noodle.index')->with('success', 'Data Pemeriksaan Pemasakan Noodle berhasil dihapus');
}
}
