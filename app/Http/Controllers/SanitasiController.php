<?php

namespace App\Http\Controllers;

use App\Models\Sanitasi;
use Illuminate\Http\Request;

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
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

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

        // Upload gambar Foot Basin
        if ($request->hasFile('aktual_footbasin')) {
            $data['aktual_footbasin'] = $request->file('aktual_footbasin')->store('uploads/footbasin', 'public');
        }

        // Upload gambar Hand Basin
        if ($request->hasFile('aktual_handbasin')) {
            $data['aktual_handbasin'] = $request->file('aktual_handbasin')->store('uploads/handbasin', 'public');
        }

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Sanitasi::create($data);

        return redirect()->route('sanitasi.index')->with('success', 'Data sanitasi berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();
        return view('form.sanitasi.edit', compact('sanitasi'));
    }

    public function update(Request $request, string $uuid)
    {
        $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

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

    // Upload gambar Foot Basin
        if ($request->hasFile('aktual_footbasin')) {
            if ($sanitasi->aktual_footbasin && \Storage::disk('public')->exists($sanitasi->aktual_footbasin)) {
                \Storage::disk('public')->delete($sanitasi->aktual_footbasin);
            }
            $data['aktual_footbasin'] = $request->file('aktual_footbasin')->store('uploads/footbasin', 'public');
        } else {
        // tetap pakai file lama
            $data['aktual_footbasin'] = $sanitasi->aktual_footbasin;
        }

    // Upload gambar Hand Basin
        if ($request->hasFile('aktual_handbasin')) {
            if ($sanitasi->aktual_handbasin && \Storage::disk('public')->exists($sanitasi->aktual_handbasin)) {
                \Storage::disk('public')->delete($sanitasi->aktual_handbasin);
            }
            $data['aktual_handbasin'] = $request->file('aktual_handbasin')->store('uploads/handbasin', 'public');
        } else {
            $data['aktual_handbasin'] = $sanitasi->aktual_handbasin;
        }

    // Tambahkan info username update dan nama produksi
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $sanitasi->update($data);

        return redirect()->route('sanitasi.index')->with('success', 'Data sanitasi berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $sanitasi = Sanitasi::where('uuid', $uuid)->firstOrFail();
        $sanitasi->delete();

        return redirect()->route('sanitasi.index')->with('success', 'Data sanitasi berhasil dihapus');
    }
}
