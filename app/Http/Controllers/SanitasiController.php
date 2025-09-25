<?php

namespace App\Http\Controllers;

use App\Models\Sanitasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SanitasiController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Sanitasi::query()
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

        return view('form.sanitasi.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.sanitasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'  => 'required|date',
            'pukul' => 'required',
            'shift' => 'required',
            'std_footbasin'   => 'nullable|string',
            'std_handbasin'   => 'nullable|string',
            'aktual_footbasin' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'aktual_handbasin' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tindakan_koreksi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'pukul', 'shift',
            'std_footbasin', 'std_handbasin', 'tindakan_koreksi',
            'keterangan', 'catatan'
        ]);

        if ($request->hasFile('aktual_footbasin')) {
            $data['aktual_footbasin'] = $request->file('aktual_footbasin')->store('uploads/footbasin', 'public');
        }

        if ($request->hasFile('aktual_handbasin')) {
            $data['aktual_handbasin'] = $request->file('aktual_handbasin')->store('uploads/handbasin', 'public');
        }

        $data['username']         = Auth::user()->username;
        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi']    = session()->has('selected_produksi') 
        ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name 
        : null;
        $data['status_produksi']  = "1";
        $data['status_spv']       = "0";

        $sanitasi = Sanitasi::create($data);

    // Set tgl_update_produksi = created_at + 1 jam
        $sanitasi->update(['tgl_update_produksi' => Carbon::parse($sanitasi->created_at)->addHour()]);

        return redirect()->route('sanitasi.index')->with('success', 'Data sanitasi berhasil disimpan');
    }

    public function update(Request $request, string $uuid)
    {
        $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'date'  => 'required|date',
            'pukul' => 'required',
            'shift' => 'required',
            'std_footbasin'   => 'nullable|string',
            'std_handbasin'   => 'nullable|string',
            'aktual_footbasin' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'aktual_handbasin' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tindakan_koreksi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'pukul', 'shift',
            'std_footbasin', 'std_handbasin', 'tindakan_koreksi',
            'keterangan', 'catatan'
        ]);

        if ($request->hasFile('aktual_footbasin')) {
            if ($sanitasi->aktual_footbasin && \Storage::disk('public')->exists($sanitasi->aktual_footbasin)) {
                \Storage::disk('public')->delete($sanitasi->aktual_footbasin);
            }
            $data['aktual_footbasin'] = $request->file('aktual_footbasin')->store('uploads/footbasin', 'public');
        } else {
            $data['aktual_footbasin'] = $sanitasi->aktual_footbasin;
        }

        if ($request->hasFile('aktual_handbasin')) {
            if ($sanitasi->aktual_handbasin && \Storage::disk('public')->exists($sanitasi->aktual_handbasin)) {
                \Storage::disk('public')->delete($sanitasi->aktual_handbasin);
            }
            $data['aktual_handbasin'] = $request->file('aktual_handbasin')->store('uploads/handbasin', 'public');
        } else {
            $data['aktual_handbasin'] = $sanitasi->aktual_handbasin;
        }

        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi']    = session()->has('selected_produksi') 
        ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name 
        : null;

        $sanitasi->update($data);

    // Update tgl_update_produksi = updated_at + 1 jam
        $sanitasi->update(['tgl_update_produksi' => Carbon::parse($sanitasi->updated_at)->addHour()]);

        return redirect()->route('sanitasi.index')->with('success', 'Data sanitasi berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();
        $sanitasi->delete();

        return redirect()->route('sanitasi.index')->with('success', 'Data sanitasi berhasil dihapus');
    }
}
