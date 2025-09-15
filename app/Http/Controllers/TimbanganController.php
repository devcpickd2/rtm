<?php

namespace App\Http\Controllers;

use App\Models\Timbangan;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;
use Carbon\Carbon;

class TimbanganController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Timbangan::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('kode_timbangan', 'like', "%{$search}%")
            ->orWhere('standar', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('waktu_tera', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.timbangan.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.timbangan.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'kode_timbangan' => 'required',
            'standar' => 'required',
            'waktu_tera' => 'required',
            'hasil_tera' => 'required',
            'tindakan_perbaikan'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift',
            'kode_timbangan', 'standar', 'waktu_tera', 'hasil_tera', 'tindakan_perbaikan', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Timbangan::create($data);

        return redirect()->route('timbangan.index')->with('success', 'Data Peneraan Timbangan berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();
        return view('form.timbangan.edit', compact('timbangan'));
    }

    public function update(Request $request, string $uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
           'date'  => 'required|date',
           'shift' => 'required',
           'kode_timbangan' => 'required',
           'standar' => 'required',
           'waktu_tera' => 'required',
           'hasil_tera' => 'required',
           'tindakan_perbaikan'   => 'nullable|string',
           'catatan'    => 'nullable|string',
       ]);

        $data = $request->only([
         'date', 'shift',
         'kode_timbangan', 'standar', 'waktu_tera', 'hasil_tera', 'tindakan_perbaikan', 'catatan'
     ]);
        
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $timbangan->update($data);

        return redirect()->route('timbangan.index')->with('success', 'Data Peneraan Timbangan berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $timbangan = Timbangan::where('uuid', $uuid)->firstOrFail();
        $timbangan->delete();

        return redirect()->route('timbangan.index')->with('success', 'Data Peneraan Timbangan berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $exportDate = $request->input('export_date');

        if (!$exportDate) {
            return redirect()->back()->with('error', 'Tanggal export harus diisi.');
        }

        $data = Timbangan::whereDate('date', $exportDate)->get();

        return Pdf::view('pdf.peneraan-timbangan', [
            'tanggal'  => Carbon::parse($exportDate)->format('d/m/Y'),
            'data'     => $data,
            'shift'    => $data->isNotEmpty() ? $data->first()->shift : '-',
            'doc_code' => 'QR 13/01',
        ])
        ->format('a4')
        ->name('peneraan-timbangan-' . $exportDate . '.pdf');
    }
}
