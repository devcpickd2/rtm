<?php

namespace App\Http\Controllers;

use App\Models\Verifikasi_sanitasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Verifikasi_sanitasiController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Verifikasi_sanitasi::query()
            ->when($search, function ($query) use ($search) {
                $query->where('username', 'like', "%{$search}%")
                      ->orWhere('area', 'like', "%{$search}%")
                      ->orWhere('mesin', 'like', "%{$search}%");
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                $query->whereBetween('date', [$start_date, $end_date]);
            })
            ->orderBy('date', 'desc')
            ->orderBy('pukul', 'desc')
            ->paginate(10)
            ->appends($request->all());

        return view('form.verifikasi_sanitasi.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.verifikasi_sanitasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'pukul' => 'required|date_format:H:i',
            'area'  => 'required|string',
            'mesin' => 'required|string',
            'cleaning_agents' => 'nullable|string',
            'keterangan'      => 'nullable|string',
            'catatan'         => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift', 'pukul', 'area', 'mesin', 'cleaning_agents', 'keterangan', 'catatan'
        ]);

        // Kalau TIME di DB pakai HH:MM:SS
        if (strlen($data['pukul']) === 5) {
            $data['pukul'] .= ':00';
        }

        $data['username']         = Auth::user()->username;
        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi']    = session()->has('selected_produksi')
                                    ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
                                    : null;
        $data['status_produksi']  = "1";
        $data['status_spv']       = "0";

        $verifikasi = Verifikasi_sanitasi::create($data);

        // Set tgl_update_produksi = created_at + 1 jam
        $verifikasi->update(['tgl_update_produksi' => Carbon::parse($verifikasi->created_at)->addHour()]);

        return redirect()->route('verifikasi_sanitasi.index')
            ->with('success', 'Data Verifikasi Sanitasi berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $verifikasi_sanitasi = Verifikasi_sanitasi::where('uuid', $uuid)->firstOrFail();
        return view('form.verifikasi_sanitasi.edit', compact('verifikasi_sanitasi'));
    }

    public function update(Request $request, string $uuid)
    {
        $verifikasi_sanitasi = Verifikasi_sanitasi::findOrFail($uuid);

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'pukul' => 'required',
            'area'  => 'required|string',
            'mesin' => 'required|string',
            'cleaning_agents' => 'nullable|string',
            'keterangan'      => 'nullable|string',
            'catatan'         => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift', 'pukul', 'area', 'mesin', 'cleaning_agents', 'keterangan', 'catatan'
        ]);

        if (strlen($data['pukul']) === 5) {
            $data['pukul'] .= ':00';
        }

        $data['username_updated'] = Auth::user()->username;
        $data['nama_produksi']    = session()->has('selected_produksi')
                                    ? \App\Models\User::where('uuid', session('selected_produksi'))->first()->name
                                    : null;

        $verifikasi_sanitasi->update($data);

        // Update tgl_update_produksi = updated_at + 1 jam
        $verifikasi_sanitasi->update(['tgl_update_produksi' => Carbon::parse($verifikasi_sanitasi->updated_at)->addHour()]);

        return redirect()->route('verifikasi_sanitasi.index')
            ->with('success', 'Data Verifikasi Sanitasi berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $verifikasi_sanitasi = Verifikasi_sanitasi::where('uuid', $uuid)->firstOrFail();
        $verifikasi_sanitasi->delete();

        return redirect()->route('verifikasi_sanitasi.index')
            ->with('success', 'Data Verifikasi Sanitasi berhasil dihapus');
    }
}
