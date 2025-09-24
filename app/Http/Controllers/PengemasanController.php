<?php

namespace App\Http\Controllers;

use App\Models\Pengemasan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengemasanController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Pengemasan::query()
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

        return view('form.pengemasan.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.pengemasan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'pukul'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'tray_checking' => 'nullable|array',
            'box_checking'  => 'nullable|array',
            'tray_packing'  => 'nullable|array',
            'box_packing'   => 'nullable|array',
            'keterangan_checking' => 'nullable|string',
            'keterangan_packing'  => 'nullable|string',
            'catatan'      => 'nullable|string',
        ]);

        $trayChecking  = $request->input('tray_checking', []);
        $boxChecking   = $request->input('box_checking', []);
        $trayPacking   = $request->input('tray_packing', []);
        $boxPacking    = $request->input('box_packing', []);

        // Upload semua file jika ada
        if ($request->hasFile('tray_checking.kode_produksi')) {
            $trayChecking['kode_produksi'] = $request->file('tray_checking.kode_produksi')->store('uploads/pengemasan', 'public');
        }
        if ($request->hasFile('box_checking.kode_produksi')) {
            $boxChecking['kode_produksi'] = $request->file('box_checking.kode_produksi')->store('uploads/pengemasan', 'public');
        }
        if ($request->hasFile('tray_packing.kode_produksi')) {
            $trayPacking['kode_produksi'] = $request->file('tray_packing.kode_produksi')->store('uploads/pengemasan', 'public');
        }
        if ($request->hasFile('box_packing.kode_produksi')) {
            $boxPacking['kode_produksi'] = $request->file('box_packing.kode_produksi')->store('uploads/pengemasan', 'public');
        }

        $data = $request->only([
            'date','shift','pukul','nama_produk','kode_produksi',
            'keterangan_checking','keterangan_packing','catatan'
        ]);

        $data['username']        = $username;
        $data['nama_produksi']   = $nama_produksi;
        $data['status_produksi'] = 1;
        $data['status_spv']      = 0;

        $data['tray_checking'] = json_encode($trayChecking, JSON_UNESCAPED_UNICODE);
        $data['box_checking']  = json_encode($boxChecking, JSON_UNESCAPED_UNICODE);
        $data['tray_packing']  = json_encode($trayPacking, JSON_UNESCAPED_UNICODE);
        $data['box_packing']   = json_encode($boxPacking, JSON_UNESCAPED_UNICODE);

        Pengemasan::create($data);

        return redirect()->route('pengemasan.index')
            ->with('success', 'Data Pemeriksaan Pengemasan berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $pengemasan = Pengemasan::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        $trayChecking = json_decode($pengemasan->tray_checking, true) ?? [];
        $boxChecking  = json_decode($pengemasan->box_checking, true) ?? [];
        $trayPacking  = json_decode($pengemasan->tray_packing, true) ?? [];
        $boxPacking   = json_decode($pengemasan->box_packing, true) ?? [];

        return view('form.pengemasan.edit', compact(
            'pengemasan','produks','trayChecking','boxChecking','trayPacking','boxPacking'
        ));
    }

    public function update(Request $request, string $uuid)
    {
        $pengemasan = Pengemasan::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'pukul'       => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'tray_checking' => 'nullable|array',
            'box_checking'  => 'nullable|array',
            'tray_packing'  => 'nullable|array',
            'box_packing'   => 'nullable|array',
            'keterangan_checking' => 'nullable|string',
            'keterangan_packing'  => 'nullable|string',
            'catatan'      => 'nullable|string',
        ]);

        $trayChecking    = $request->input('tray_checking', []);
        $boxChecking     = $request->input('box_checking', []);
        $trayPacking     = $request->input('tray_packing', []);
        $boxPacking      = $request->input('box_packing', []);

        // Decode old files
        $oldTrayChecking = json_decode($pengemasan->tray_checking, true) ?? [];
        $oldBoxChecking  = json_decode($pengemasan->box_checking, true) ?? [];
        $oldTrayPacking  = json_decode($pengemasan->tray_packing, true) ?? [];
        $oldBoxPacking   = json_decode($pengemasan->box_packing, true) ?? [];

        // Upload baru atau pakai file lama
        if ($request->hasFile('tray_checking.kode_produksi')) {
            if (!empty($oldTrayChecking['kode_produksi']) && Storage::disk('public')->exists($oldTrayChecking['kode_produksi'])) {
                Storage::disk('public')->delete($oldTrayChecking['kode_produksi']);
            }
            $trayChecking['kode_produksi'] = $request->file('tray_checking.kode_produksi')->store('uploads/pengemasan', 'public');
        } else {
            $trayChecking['kode_produksi'] = $oldTrayChecking['kode_produksi'] ?? null;
        }

        if ($request->hasFile('box_checking.kode_produksi')) {
            if (!empty($oldBoxChecking['kode_produksi']) && Storage::disk('public')->exists($oldBoxChecking['kode_produksi'])) {
                Storage::disk('public')->delete($oldBoxChecking['kode_produksi']);
            }
            $boxChecking['kode_produksi'] = $request->file('box_checking.kode_produksi')->store('uploads/pengemasan', 'public');
        } else {
            $boxChecking['kode_produksi'] = $oldBoxChecking['kode_produksi'] ?? null;
        }

        if ($request->hasFile('tray_packing.kode_produksi')) {
            if (!empty($oldTrayPacking['kode_produksi']) && Storage::disk('public')->exists($oldTrayPacking['kode_produksi'])) {
                Storage::disk('public')->delete($oldTrayPacking['kode_produksi']);
            }
            $trayPacking['kode_produksi'] = $request->file('tray_packing.kode_produksi')->store('uploads/pengemasan', 'public');
        } else {
            $trayPacking['kode_produksi'] = $oldTrayPacking['kode_produksi'] ?? null;
        }

        if ($request->hasFile('box_packing.kode_produksi')) {
            if (!empty($oldBoxPacking['kode_produksi']) && Storage::disk('public')->exists($oldBoxPacking['kode_produksi'])) {
                Storage::disk('public')->delete($oldBoxPacking['kode_produksi']);
            }
            $boxPacking['kode_produksi'] = $request->file('box_packing.kode_produksi')->store('uploads/pengemasan', 'public');
        } else {
            $boxPacking['kode_produksi'] = $oldBoxPacking['kode_produksi'] ?? null;
        }

        $data = [
            'date'                => $request->date,
            'shift'               => $request->shift,
            'pukul'               => $request->pukul,
            'nama_produk'         => $request->nama_produk,
            'kode_produksi'       => $request->kode_produksi,
            'keterangan_checking' => $request->keterangan_checking,
            'keterangan_packing'  => $request->keterangan_packing,
            'catatan'             => $request->catatan,
            'username_updated'    => $username_updated,
            'nama_produksi'       => $nama_produksi,
            'tray_checking'       => json_encode($trayChecking, JSON_UNESCAPED_UNICODE),
            'box_checking'        => json_encode($boxChecking, JSON_UNESCAPED_UNICODE),
            'tray_packing'        => json_encode($trayPacking, JSON_UNESCAPED_UNICODE),
            'box_packing'         => json_encode($boxPacking, JSON_UNESCAPED_UNICODE),
        ];

        $pengemasan->update($data);

        return redirect()->route('pengemasan.index')
            ->with('success', 'Data Pemeriksaan Pengemasan berhasil diperbarui');
    }

    public function destroy(string $uuid)
    {
        $pengemasan = Pengemasan::where('uuid', $uuid)->firstOrFail();

        // Hapus semua file jika ada
        $trayChecking = json_decode($pengemasan->tray_checking, true) ?? [];
        $boxChecking  = json_decode($pengemasan->box_checking, true) ?? [];
        $trayPacking  = json_decode($pengemasan->tray_packing, true) ?? [];
        $boxPacking   = json_decode($pengemasan->box_packing, true) ?? [];

        foreach ([$trayChecking, $boxChecking, $trayPacking, $boxPacking] as $fileArray) {
            if (!empty($fileArray['kode_produksi']) && Storage::disk('public')->exists($fileArray['kode_produksi'])) {
                Storage::disk('public')->delete($fileArray['kode_produksi']);
            }
        }

        $pengemasan->delete();

        return redirect()->route('pengemasan.index')
            ->with('success', 'Data Pemeriksaan Pengemasan berhasil dihapus');
    }
}
