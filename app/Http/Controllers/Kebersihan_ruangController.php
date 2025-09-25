<?php

namespace App\Http\Controllers;

use App\Models\Kebersihan_ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $request->validate([
            'date'    => 'required|date',
            'shift'   => 'required',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only(['date', 'shift', 'catatan']);
        $data['username']         = Auth::user()->username;
        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi']    = session()->has('selected_produksi')
                                    ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
                                    : null;
        $data['status_produksi']  = "1";
        $data['status_spv']       = "0";

        $areas = [
            'rice_boiling', 'noodle', 'cr_rm', 'cs_1', 'cs_2',
            'seasoning', 'prep_room', 'cooking', 'filling',
            'topping', 'packing', 'iqf', 'cs_fg', 'ds'
        ];

        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        $kebersihan = Kebersihan_ruang::create($data);

        // Set tgl_update_produksi = created_at + 1 jam
        $kebersihan->update(['tgl_update_produksi' => Carbon::parse($kebersihan->created_at)->addHour()]);

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

        $request->validate([
            'date'    => 'required|date',
            'shift'   => 'required',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only(['date', 'shift', 'catatan']);
        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi']    = session()->has('selected_produksi')
                                    ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
                                    : null;

        $areas = [
            'rice_boiling', 'noodle', 'cr_rm', 'cs_1', 'cs_2',
            'seasoning', 'prep_room', 'cooking', 'filling',
            'topping', 'packing', 'iqf', 'cs_fg', 'ds'
        ];

        foreach ($areas as $area) {
            $data[$area] = $request->input($area, []);
        }

        $kebersihan_ruang->update($data);

        // Update tgl_update_produksi = updated_at + 1 jam
        $kebersihan_ruang->update(['tgl_update_produksi' => Carbon::parse($kebersihan_ruang->updated_at)->addHour()]);

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
