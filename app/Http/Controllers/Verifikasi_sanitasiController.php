<?php

namespace App\Http\Controllers;

use App\Models\Verifikasi_sanitasi;
use Illuminate\Http\Request;

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
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'pukul' => 'required|date_format:H:i',
            'area' => 'required|string',
            'mesin' => 'required|string',
            'cleaning_agents' => 'nullable|string',
            'keterangan'   => 'nullable|string',
            'catatan'   => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift', 'pukul', 'area', 'mesin', 'cleaning_agents', 'keterangan', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Verifikasi_sanitasi::create($data);

        return redirect()->route('verifikasi_sanitasi.index')->with('success', 'Data Verifikasi Sanitasi berhasil disimpan');
    }

    public function edit(string $uuid)
    {
    // pakai huruf besar sesuai nama model
        $verifikasi_sanitasi = Verifikasi_sanitasi::where('uuid', $uuid)->firstOrFail();
        return view('form.verifikasi_sanitasi.edit', compact('verifikasi_sanitasi'));
    }

    public function update(Request $request, string $uuid)
    {
    // Ambil data
        $verifikasi_sanitasi = Verifikasi_sanitasi::findOrFail($uuid);

    // Validasi
        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'pukul' => 'required', 
            'area' => 'required|string',
            'mesin' => 'required|string',
            'cleaning_agents' => 'nullable|string',
            'keterangan'   => 'nullable|string',
            'catatan'   => 'nullable|string',
        ]);

    // Ambil hanya field yang diperlukan
        $data = $request->only([
            'date', 'shift', 'pukul', 'area', 'mesin', 'cleaning_agents', 'keterangan', 'catatan'
        ]);

    // Kalau kolom TIME di DB butuh format HH:MM:SS → tambahkan :00
        if (strlen($data['pukul']) === 5) {
            $data['pukul'] = $data['pukul'] . ':00';
        }

        $data['username_updated'] = session('username_updated', 'Harnis');
        $data['nama_produksi']    = session('nama_produksi', 'Produksi RTM');

    // Update dengan fill()->save()
        $verifikasi_sanitasi->fill($data);
        $verifikasi_sanitasi->save();

    // Debug kalau perlu:
    // dd($verifikasi_sanitasi->getChanges());

        return redirect()->route('verifikasi_sanitasi.index')
        ->with('success', 'Data Verifikasi Sanitasi berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $verifikasi_sanitasi = Verifikasi_sanitasi::where('uuid', $uuid)->firstOrFail();
        $verifikasi_sanitasi->delete();

        return redirect()->route('verifikasi_sanitasi.index')->with('success', 'Data Verifikasi Sanitasi berhasil dihapus');
    }
}
