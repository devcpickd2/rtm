<?php

namespace App\Http\Controllers;

use App\Models\Kontaminasi;
use App\Models\Produk;
use Illuminate\Http\Request;

class KontaminasiController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Kontaminasi::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produksi', 'like', "%{$search}%")
            ->orWhere('jenis_kontaminasi', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('pukul', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.kontaminasi.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.kontaminasi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'pukul' => 'required',
            'jenis_kontaminasi'   => 'required',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'nama_produk'   => 'required',
            'kode_produksi'   => 'required',
            'tahapan' => 'nullable|string',
            'tindakan_koreksi' => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'pukul', 'shift',
            'jenis_kontaminasi', 'nama_produk', 'kode_produksi', 'tahapan', 'tindakan_koreksi', 'catatan'
        ]);

        // Upload gambar Kontaminasi
        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('uploads/kontaminasi', 'public');
        }

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Kontaminasi::create($data);

        return redirect()->route('kontaminasi.index')->with('success', 'Data Kontaminasi Benda Asing berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $produks = Produk::all();
        $kontaminasi = Kontaminasi::where('uuid', $uuid)->firstOrFail();
        return view('form.kontaminasi.edit', compact('kontaminasi', 'produks'));
    }

    public function update(Request $request, string $uuid)
    {
        $kontaminasi = Kontaminasi::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
           'date'  => 'required|date',
           'shift' => 'required',
           'pukul' => 'required',
           'jenis_kontaminasi'   => 'required',
           'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
           'nama_produk'   => 'required',
           'kode_produksi'   => 'required',
           'tahapan' => 'nullable|string',
           'tindakan_koreksi' => 'nullable|string',
           'catatan'    => 'nullable|string',
       ]);

        $data = $request->only([
            'date', 'pukul', 'shift',
            'jenis_kontaminasi', 'nama_produk', 'kode_produksi', 'tahapan', 'tindakan_koreksi', 'catatan'
        ]);

    // Upload gambar Foot Basin
        if ($request->hasFile('bukti')) {
            if ($kontaminasi->bukti && \Storage::disk('public')->exists($kontaminasi->bukti)) {
                \Storage::disk('public')->delete($kontaminasi->bukti);
            }
            $data['bukti'] = $request->file('bukti')->store('uploads/kontaminasi', 'public');
        } else {
        // tetap pakai file lama
            $data['bukti'] = $kontaminasi->bukti;
        }

    // Tambahkan info username update dan nama produksi
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $kontaminasi->update($data);

        return redirect()->route('kontaminasi.index')->with('success', 'Data Kontaminasi Benda Asing berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $kontaminasi = Kontaminasi::where('uuid', $uuid)->firstOrFail();
        $kontaminasi->delete();

        return redirect()->route('kontaminasi.index')->with('success', 'Data Kontaminasi Benda Asing berhasil dihapus');
    }
}
