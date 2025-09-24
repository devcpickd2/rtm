<?php

namespace App\Http\Controllers;

use App\Models\Kebersihan_ruang;
use Illuminate\Http\Request;

class Kebersihan_ruangController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Kebersihan_ruang::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produksi', 'like', "%{$search}%")
            ->orWhere('shift', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.kebersihan_ruang.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.kebersihan_ruang.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'    => 'required|date',
            'shift'   => 'required',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only(['date', 'shift', 'catatan']);
        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        // daftar semua area yang punya input tabel
        $areas = [
            'rice_boiling', 'noodle', 'cr_rm', 'cs_1', 'cs_2',
            'seasoning', 'prep_room', 'cooking', 'filling',
            'topping', 'packing', 'iqf', 'cs_fg', 'ds'
        ];

        // simpan tiap area ke kolom masing-masing (langsung array, biar casts yang urus)
        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        Kebersihan_ruang::create($data);

        return redirect()->route('kebersihan_ruang.index')
        ->with('success', 'Data Kebersihan Ruangan berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $kebersihan_ruang = Kebersihan_ruang::where('uuid', $uuid)->firstOrFail();
        return view('form.kebersihan_ruang.edit', compact('kebersihan_ruang'));
    }

    public function update(Request $request, string $uuid)
    {
        $kebersihan_ruang = Kebersihan_ruang::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'    => 'required|date',
            'shift'   => 'required',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only(['date', 'shift', 'catatan']);
        $data['username_updated'] = $username_updated;
        $data['nama_produksi']    = $nama_produksi;

        $areas = [
            'rice_boiling', 'noodle', 'cr_rm', 'cs_1', 'cs_2',
            'seasoning', 'prep_room', 'cooking', 'filling',
            'topping', 'packing', 'iqf', 'cs_fg', 'ds'
        ];

        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        $kebersihan_ruang->update($data);

        return redirect()->route('kebersihan_ruang.index')
        ->with('success', 'Data Kebersihan Ruangan berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $kebersihan_ruang = Kebersihan_ruang::where('uuid', $uuid)->firstOrFail();
        $kebersihan_ruang->delete();

        return redirect()->route('kebersihan_ruang.index')
        ->with('success', 'Data Kebersihan Ruangan berhasil dihapus');
    }
}
