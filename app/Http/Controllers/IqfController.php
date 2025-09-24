<?php

namespace App\Http\Controllers;

use App\Models\Iqf;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class IqfController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Iqf::query()
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

    // 🔹 Decode suhu_pusat di sini agar Blade langsung pakai array
        foreach ($data as $row) {
            if (is_string($row->suhu_pusat)) {
                $decoded = json_decode($row->suhu_pusat, true);
                $row->suhu_pusat = is_array($decoded) ? $decoded : [];
            } elseif (!is_array($row->suhu_pusat)) {
                $row->suhu_pusat = [];
            }
        }

        return view('form.iqf.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.iqf.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'shift' => 'required',
            'nama_produk' => 'required|string',
            'kode_produksi' => 'required|string',
            'no_iqf' => 'nullable|string',
            'pukul' => 'nullable|date_format:H:i',
            'std_suhu' => 'nullable|numeric',
            'average' => 'nullable|numeric',
            'problem' => 'nullable|string',
            'tindakan_koreksi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'suhu_pusat' => 'nullable|array',
        ]);

        $suhuInput = $request->input('suhu_pusat', []);
        $suhu = [];
        for ($i = 1; $i <= 10; $i++) {
            $suhu[] = [
                'value' => $suhuInput[$i]['value'] ?? '',
                'ket'   => $suhuInput[$i]['ket'] ?? '',
            ];
        }

        $iqf = Iqf::create([
            'date' => $request->date,
            'shift' => $request->shift,
            'nama_produk' => $request->nama_produk,
            'kode_produksi' => $request->kode_produksi,
            'no_iqf' => $request->no_iqf,
            'pukul' => $request->pukul,
            'std_suhu' => $request->std_suhu !== null ? (float)$request->std_suhu : null,
            'average' => $request->average !== null ? (float)$request->average : null,
            'problem' => $request->problem,
            'tindakan_koreksi' => $request->tindakan_koreksi,
            'catatan' => $request->catatan,
            'suhu_pusat' => $suhu,
            'username' => session('username', 'Putri'),
            'nama_produksi' => session('nama_produksi', 'Produksi RTM'),
            'status_produksi' => "1",
            'status_spv' => "0",
        ]);

        return redirect()->route('iqf.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($uuid)
    {
        $iqf = Iqf::where('uuid', $uuid)->firstOrFail();
    $produks = Produk::all(); // ambil produk untuk select
    return view('form.iqf.edit', compact('iqf','produks'));
}

public function update(Request $request, $uuid)
{
    $request->validate([
        'date' => 'required|date',
        'shift' => 'required',
        'nama_produk' => 'required',
        'kode_produksi' => 'required',
    ]);

    $iqf = Iqf::where('uuid',$uuid)->firstOrFail();

    // Simpan data biasa
    $iqf->date = $request->date;
    $iqf->shift = $request->shift;
    $iqf->no_iqf = $request->no_iqf;
    $iqf->nama_produk = $request->nama_produk;
    $iqf->kode_produksi = $request->kode_produksi;
    $iqf->std_suhu = $request->std_suhu;
    $iqf->pukul = $request->pukul;
    $iqf->average = $request->average;
    $iqf->problem = $request->problem;
    $iqf->tindakan_koreksi = $request->tindakan_koreksi;
    $iqf->catatan = $request->catatan;

    // suhu_pusat bisa disimpan sebagai JSON
    $iqf->suhu_pusat = $request->suhu_pusat; // pastikan field tipe json/text

    $iqf->save();

    return redirect()->route('iqf.index')->with('success','Data berhasil diupdate');
}


public function destroy($uuid)
{
    $iqf = Iqf::where('uuid', $uuid)->firstOrFail();
    $iqf->delete();

    return redirect()->route('iqf.index')->with('success', 'Data berhasil dihapus');
}
}