<?php

namespace App\Http\Controllers;

use App\Models\Gmp;
use App\Models\Produksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.gmp.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $karyawanNoodle  = Produksi::where('area', 'Noodle & Rice')->pluck('nama_karyawan')->toArray();
        $karyawanCooking = Produksi::where('area', 'Cooking')->pluck('nama_karyawan')->toArray();
        $karyawanPacking = Produksi::where('area', 'Packing')->pluck('nama_karyawan')->toArray();

        return view('form.gmp.create', compact('karyawanNoodle', 'karyawanCooking', 'karyawanPacking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $data = $request->only(['date']);
        $data['username'] = Auth::user()->username;
        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi'] = session()->has('selected_produksi')
        ? User::where('uuid', session('selected_produksi'))->first()->name
        : null;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        $areas = ['noodle_rice', 'cooking', 'packing'];
        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        $gmp = Gmp::create($data);

        // Set tgl_update_produksi = created_at + 1 jam
        $gmp->update(['tgl_update_produksi' => Carbon::parse($gmp->created_at)->addHour()]);

        return redirect()->route('gmp.index')
        ->with('success', 'Data GMP Karyawan berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $gmp = Gmp::where('uuid', $uuid)->firstOrFail();

        $karyawanNoodle  = Produksi::where('area', 'Noodle & Rice')->pluck('nama_karyawan')->toArray();
        $karyawanCooking = Produksi::where('area', 'Cooking')->pluck('nama_karyawan')->toArray();
        $karyawanPacking = Produksi::where('area', 'Packing')->pluck('nama_karyawan')->toArray();

        return view('form.gmp.edit', compact('gmp', 'karyawanNoodle', 'karyawanCooking', 'karyawanPacking'));
    }

    public function update(Request $request, string $uuid)
    {
        $gmp = Gmp::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'date' => 'required|date',
        ]);

        $data = $request->only(['date']);
        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi'] = session()->has('selected_produksi')
        ? User::where('uuid', session('selected_produksi'))->first()->name
        : null;

        $areas = ['noodle_rice', 'cooking', 'packing'];
        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        $gmp->update($data);

        // Update tgl_update_produksi = updated_at + 1 jam
        $gmp->update(['tgl_update_produksi' => Carbon::parse($gmp->updated_at)->addHour()]);

        return redirect()->route('gmp.index')
        ->with('success', 'Data GMP Karyawan berhasil diperbarui');
    }

    public function destroy(string $uuid)
    {
        $gmp = Gmp::where('uuid', $uuid)->firstOrFail();
        $gmp->delete();

        return redirect()->route('gmp.index')
        ->with('success', 'Data GMP Karyawan berhasil dihapus');
    }
}
