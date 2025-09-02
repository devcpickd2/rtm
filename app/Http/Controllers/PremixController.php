<?php

namespace App\Http\Controllers;

use App\Models\Premix;
use Illuminate\Http\Request;

class PremixController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Premix::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_premix', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.premix.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.premix.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'nama_premix' => 'required',
            'kode_produksi' => 'required',
            'sensori'   => 'nullable|string',
            'tindakan_koreksi'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift',
            'nama_premix', 'kode_produksi', 'sensori',
            'tindakan_koreksi', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Premix::create($data);

        return redirect()->route('premix.index')->with('success', 'Data Verifikasi Premix berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $premix = Premix::where('uuid', $uuid)->firstOrFail();
        return view('form.premix.edit', compact('premix'));
    }

    public function update(Request $request, string $uuid)
    {
        $premix = Premix::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
           'date'  => 'required|date',
           'shift' => 'required',
           'nama_premix' => 'required',
           'kode_produksi' => 'required',
           'sensori'   => 'nullable|string',
           'tindakan_koreksi'   => 'nullable|string',
           'catatan'    => 'nullable|string',
       ]);

        $data = $request->only([
         'date', 'shift',
         'nama_premix', 'kode_produksi', 'sensori',
         'tindakan_koreksi', 'catatan'
     ]);
        
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $premix->update($data);

        return redirect()->route('premix.index')->with('success', 'Data Verifikasi Premix berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $premix = Premix::where('uuid', $uuid)->firstOrFail();
        $premix->delete();

        return redirect()->route('premix.index')->with('success', 'Data Verifikasi Premix berhasil dihapus');
    }
}
