<?php

namespace App\Http\Controllers;

use App\Models\Cooking;
use App\Models\Produk;
use Illuminate\Http\Request;

class CookingController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Cooking::query()
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

        return view('form.cooking.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.cooking.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'          => 'required|date',
            'shift'         => 'required',
            'nama_produk'   => 'required',
            'sub_produk'    => 'nullable|string',
            'jenis_produk'  => 'required',
            'kode_produksi' => 'required',
            'waktu_mulai'   => 'nullable',
            'waktu_selesai' => 'nullable',
            'nama_mesin'    => 'required',
            'catatan'       => 'nullable|string',
            'pemasakan'     => 'nullable|array',
        ]);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'sub_produk'       => $request->sub_produk,
            'jenis_produk'     => $request->jenis_produk,
            'kode_produksi'    => $request->kode_produksi,
            'waktu_mulai'      => $request->waktu_mulai,
            'waktu_selesai'    => $request->waktu_selesai,
            'nama_mesin'       => $request->nama_mesin,
            'catatan'          => $request->catatan,
            'username'         => $username,
            'nama_produksi'    => $nama_produksi,
            'status_produksi'  => "1",
            'status_spv'       => "0",
            // encode pemasakan ke JSON
            'pemasakan'        => json_encode($request->input('pemasakan', []), JSON_UNESCAPED_UNICODE),
        ];

        Cooking::create($data);

        return redirect()->route('cooking.index')
            ->with('success', 'Data Pemeriksaan Pemasakan Produk di Steam/Cooking Kettle berhasil disimpan');
    }

    public function edit($uuid)
    {
        $cooking = Cooking::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        // Decode JSON pemasakan ke array
        $pemasakanData = json_decode($cooking->pemasakan, true) ?? [];

        return view('form.cooking.edit', compact('cooking', 'produks', 'pemasakanData'));
    }

    public function update(Request $request, $uuid)
    {
        $cooking = Cooking::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'          => 'required|date',
            'shift'         => 'required',
            'nama_produk'   => 'required',
            'sub_produk'    => 'nullable|string',
            'jenis_produk'  => 'required',
            'kode_produksi' => 'required',
            'waktu_mulai'   => 'nullable',
            'waktu_selesai' => 'nullable',
            'nama_mesin'    => 'required',
            'catatan'       => 'nullable|string',
            'pemasakan'     => 'nullable|array',
        ]);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'sub_produk'       => $request->sub_produk,
            'jenis_produk'     => $request->jenis_produk,
            'kode_produksi'    => $request->kode_produksi,
            'waktu_mulai'      => $request->waktu_mulai,
            'waktu_selesai'    => $request->waktu_selesai,
            'nama_mesin'       => $request->nama_mesin,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'nama_produksi'    => $nama_produksi,
            // encode pemasakan ke JSON
            'pemasakan'        => json_encode($request->input('pemasakan', []), JSON_UNESCAPED_UNICODE),
        ];

        $cooking->update($data);

        return redirect()->route('cooking.index')
            ->with('success', 'Data Pemeriksaan Pemasakan Produk berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $cooking = Cooking::where('uuid', $uuid)->firstOrFail();
        $cooking->delete();

        return redirect()->route('cooking.index')
            ->with('success', 'Data Pemeriksaan Pemasakan Produk di Steam/Cooking Kettle berhasil dihapus');
    }
}
