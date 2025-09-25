<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suhu;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SuhuController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Suhu::query()
            ->when($search, function ($query) use ($search) {
                $query->where('username', 'like', "%{$search}%")
                      ->orWhere('nama_produksi', 'like', "%{$search}%")
                      ->orWhere('shift', 'like', "%{$search}%");
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('date', [$start_date, $end_date]);
            })
            ->orderBy('date', 'desc')
            ->orderBy('pukul', 'desc')
            ->paginate(10)
            ->appends($request->all());

        return view('form.suhu.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.suhu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'  => 'required|date',
            'pukul' => 'required',
            'shift' => 'required',
            'chillroom'   => 'nullable|numeric',
            'cs_1'        => 'nullable|numeric',
            'cs_2'        => 'nullable|numeric',
            'anteroom_rm' => 'nullable|numeric',
            'seasoning_suhu' => 'nullable|numeric',
            'seasoning_rh'   => 'nullable|numeric',
            'rice'      => 'nullable|numeric',
            'noodle'    => 'nullable|numeric',
            'prep_room' => 'nullable|numeric',
            'cooking'   => 'nullable|numeric',
            'filling' => 'nullable|numeric',
            'topping' => 'nullable|numeric',
            'packing' => 'nullable|numeric',
            'ds_suhu' => 'nullable|numeric',
            'ds_rh'   => 'nullable|numeric',
            'cs_fg'       => 'nullable|numeric',
            'anteroom_fg' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'pukul', 'shift',
            'chillroom', 'cs_1', 'cs_2', 'anteroom_rm',
            'seasoning_suhu', 'seasoning_rh',
            'rice', 'noodle', 'prep_room', 'cooking',
            'filling', 'topping', 'packing',
            'ds_suhu', 'ds_rh',
            'cs_fg', 'anteroom_fg',
            'keterangan', 'catatan'
        ]);

        $data['username']      = Auth::user()->username;
        $data['nama_produksi'] = session()->has('selected_produksi') 
                                 ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name 
                                 : null;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        $suhu = Suhu::create($data);

        // Set tgl_update_produksi = created_at + 1 jam
        $suhu->update(['tgl_update_produksi' => Carbon::parse($suhu->created_at)->addHour()]);

        return redirect()->route('suhu.index')->with('success', 'Data Suhu berhasil disimpan');
    }

    public function edit($uuid)
    {
        $suhu = Suhu::findOrFail($uuid);
        return view('form.suhu.edit', compact('suhu'));
    }

    public function update(Request $request, $uuid)
    {
        $suhu = Suhu::findOrFail($uuid);

        $request->validate([
            'date'  => 'required|date',
            'pukul' => 'required',
            'shift' => 'required',
            'chillroom'   => 'nullable|numeric',
            'cs_1'        => 'nullable|numeric',
            'cs_2'        => 'nullable|numeric',
            'anteroom_rm' => 'nullable|numeric',
            'seasoning_suhu' => 'nullable|numeric',
            'seasoning_rh'   => 'nullable|numeric',
            'rice'      => 'nullable|numeric',
            'noodle'    => 'nullable|numeric',
            'prep_room' => 'nullable|numeric',
            'cooking'   => 'nullable|numeric',
            'filling' => 'nullable|numeric',
            'topping' => 'nullable|numeric',
            'packing' => 'nullable|numeric',
            'ds_suhu' => 'nullable|numeric',
            'ds_rh'   => 'nullable|numeric',
            'cs_fg'       => 'nullable|numeric',
            'anteroom_fg' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'pukul', 'shift',
            'chillroom', 'cs_1', 'cs_2', 'anteroom_rm',
            'seasoning_suhu', 'seasoning_rh',
            'rice', 'noodle', 'prep_room', 'cooking',
            'filling', 'topping', 'packing',
            'ds_suhu', 'ds_rh',
            'cs_fg', 'anteroom_fg',
            'keterangan', 'catatan'
        ]);

        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi'] = session()->has('selected_produksi') 
                                 ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name 
                                 : null;

        $suhu->update($data);

        // Update tgl_update_produksi = updated_at + 1 jam
        $suhu->update(['tgl_update_produksi' => Carbon::parse($suhu->updated_at)->addHour()]);

        return redirect()->route('suhu.index')->with('success', 'Data Suhu berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $suhu = Suhu::where('uuid', $uuid)->firstOrFail();
        $suhu->delete();

        return redirect()->route('suhu.index')->with('success', 'Data Suhu berhasil dihapus');
    }
}
