<?php

namespace App\Http\Controllers;

use App\Models\Thermometer;
use Illuminate\Http\Request;

class ThermometerController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Thermometer::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('kode_thermometer', 'like', "%{$search}%")
            ->orWhere('hasil_tera', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('waktu_tera', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.thermometer.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.thermometer.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'kode_thermometer' => 'required',
            'area' => 'required',
            'waktu_tera' => 'required',
            'hasil_tera' => 'required',
            'tindakan_koreksi'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift',
            'kode_thermometer', 'area', 'waktu_tera', 'hasil_tera', 'tindakan_koreksi', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";
        $data['standar'] = "0.0";

        Thermometer::create($data);

        return redirect()->route('thermometer.index')->with('success', 'Data Peneraan Thermometer berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $thermometer = Thermometer::where('uuid', $uuid)->firstOrFail();
        return view('form.thermometer.edit', compact('thermometer'));
    }

    public function update(Request $request, string $uuid)
    {
        $thermometer = Thermometer::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
           'date'  => 'required|date',
           'shift' => 'required',
           'kode_thermometer' => 'required',
           'area' => 'required',
           'waktu_tera' => 'required',
           'hasil_tera' => 'required',
           'tindakan_koreksi'   => 'nullable|string',
           'catatan'    => 'nullable|string',
       ]);

        $data = $request->only([
         'date', 'shift',
         'kode_thermometer', 'area', 'waktu_tera', 'hasil_tera', 'tindakan_koreksi', 'catatan'
     ]);
        
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;
        $data['standar'] = "0.0";

        $thermometer->update($data);

        return redirect()->route('thermometer.index')->with('success', 'Data Peneraan Thermometer berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $thermometer = Thermometer::where('uuid', $uuid)->firstOrFail();
        $thermometer->delete();

        return redirect()->route('thermometer.index')->with('success', 'Data Peneraan Thermometer berhasil dihapus');
    }
}
