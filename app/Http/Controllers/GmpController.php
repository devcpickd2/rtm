<?php

namespace App\Http\Controllers;

use App\Models\Gmp;
use App\Models\Produksi;
use Illuminate\Http\Request;

class GmpController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Gmp::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('noodle_rice', 'like', "%{$search}%")
            ->orWhere('cooking', 'like', "%{$search}%")
            ->orWhere('packing', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.gmp.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        // Ambil karyawan berdasarkan area
        $karyawanNoodle = Produksi::where('area', 'Noodle & Rice')->pluck('nama_karyawan')->toArray();
        $karyawanCooking = Produksi::where('area', 'Cooking')->pluck('nama_karyawan')->toArray();
        $karyawanPacking = Produksi::where('area', 'Packing')->pluck('nama_karyawan')->toArray();

        return view('form.gmp.create', compact('karyawanNoodle', 'karyawanCooking', 'karyawanPacking'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date' => 'required|date',
        ]);

        $data = $request->only(['date']);
        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        // simpan tiap area ke kolom masing-masing
        $areas = ['noodle_rice', 'cooking', 'packing'];

        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        Gmp::create($data);

        return redirect()->route('gmp.index')
        ->with('success', 'Data GMP Karyawan berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $gmp = Gmp::where('uuid', $uuid)->firstOrFail();

        $karyawanNoodle = Produksi::where('area', 'Noodle & Rice')->pluck('nama_karyawan')->toArray();
        $karyawanCooking = Produksi::where('area', 'Cooking')->pluck('nama_karyawan')->toArray();
        $karyawanPacking = Produksi::where('area', 'Packing')->pluck('nama_karyawan')->toArray();

        return view('form.gmp.edit', compact('gmp', 'karyawanNoodle', 'karyawanCooking', 'karyawanPacking'));
    }

    public function update(Request $request, string $uuid)
    {
        $gmp = Gmp::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date' => 'required|date',
        ]);

        $data = $request->only(['date']);
        $data['username_updated'] = $username_updated;
        $data['nama_produksi']    = $nama_produksi;

        $areas = ['noodle_rice', 'cooking', 'packing'];

        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        $gmp->update($data);

        return redirect()->route('gmp.index')
        ->with('success', 'Data GMP Karyawan berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $gmp = Gmp::where('uuid', $uuid)->firstOrFail();
        $gmp->delete();

        return redirect()->route('gmp.index')
        ->with('success', 'Data GMP Karyawan berhasil dihapus');
    }
}
