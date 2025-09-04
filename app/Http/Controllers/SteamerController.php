<?php

namespace App\Http\Controllers;

use App\Models\Steamer;
use App\Models\Produk;
use Illuminate\Http\Request;

class SteamerController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Steamer::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('steaming', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.steamer.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.steamer.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'catatan'     => 'nullable|string',
            'steaming'    => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_produk', 'catatan']);
        $data['username']        = $username;
        $data['nama_produksi']   = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv']      = "0";

        // Konversi steaming ke JSON
        $data['steaming'] = json_encode($request->input('steaming', []), JSON_UNESCAPED_UNICODE);

        Steamer::create($data);

        return redirect()->route('steamer.index')
        ->with('success', 'Data Pemeriksaan Pemasakan dengan Steamer berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $data = Steamer::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

    // Decode JSON menjadi array
        $steamingData = !empty($data->steaming) ? json_decode($data->steaming, true) : [];

        return view('form.steamer.edit', compact('data', 'produks', 'steamingData'));
    }

    public function update(Request $request, string $uuid)
    {
        $steamer = Steamer::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'catatan'     => 'nullable|string',
            'steaming'    => 'nullable|array',
        ]);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'nama_produksi'    => $nama_produksi,
            // Encode kembali steaming ke JSON
            'steaming'         => json_encode($request->input('steaming', []), JSON_UNESCAPED_UNICODE),
        ];

        $steamer->update($data);

        return redirect()->route('steamer.index')
        ->with('success', 'Data Pemeriksaan Pemasakan dengan Steamer berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $steamer = Steamer::where('uuid', $uuid)->firstOrFail();
        $steamer->delete();

        return redirect()->route('steamer.index')
        ->with('success', 'Data Pemeriksaan Pemasakan dengan Steamer berhasil dihapus');
    }
}
