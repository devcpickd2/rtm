<?php

namespace App\Http\Controllers;

use App\Models\Institusi;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;
use Carbon\Carbon;

class InstitusiController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Institusi::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('jenis_produk', 'like', "%{$search}%")
            ->orWhere('kode_produksi', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->paginate(10) 
        ->appends($request->all());

        return view('form.institusi.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        return view('form.institusi.create');
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'  => 'required|date',
            'shift' => 'required',
            'jenis_produk' => 'required',
            'kode_produksi' => 'required',
            'waktu_proses_mulai' => 'required',
            'waktu_proses_selesai' => 'required',
            'lokasi' => 'required',
            'suhu_sebelum' => 'required',
            'suhu_sesudah' => 'required',
            'sensori'   => 'nullable|string',
            'keterangan'   => 'nullable|string',
            'catatan'    => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift',
            'jenis_produk', 'kode_produksi', 'waktu_proses_mulai', 'waktu_proses_selesai', 'lokasi', 'suhu_sebelum', 'suhu_sesudah', 'sensori',
            'keterangan', 'catatan'
        ]);

        $data['username']      = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Institusi::create($data);

        return redirect()->route('institusi.index')->with('success', 'Data Verifikasi Produk Institusi berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $institusi = Institusi::where('uuid', $uuid)->firstOrFail();
        return view('form.institusi.edit', compact('institusi'));
    }

    public function update(Request $request, string $uuid)
    {
        $institusi = Institusi::where('uuid', $uuid)->firstOrFail();

    // Ambil username dan nama produksi dari session
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $request->validate([
         'date'  => 'required|date',
         'shift' => 'required',
         'jenis_produk' => 'required',
         'kode_produksi' => 'required',
         'waktu_proses_mulai' => 'required',
         'waktu_proses_selesai' => 'required',
         'lokasi' => 'required',
         'suhu_sebelum' => 'required',
         'suhu_sesudah' => 'required',
         'sensori'   => 'nullable|string',
         'keterangan'   => 'nullable|string',
         'catatan'    => 'nullable|string',
     ]);

        $data = $request->only([
           'date', 'shift',
           'jenis_produk', 'kode_produksi', 'waktu_proses_mulai', 'waktu_proses_selesai', 'lokasi', 'suhu_sebelum', 'suhu_sesudah', 'sensori',
           'keterangan', 'catatan'
       ]);
        
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $institusi->update($data);

        return redirect()->route('institusi.index')->with('success', 'Data Verifikasi Produk Institusi berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $institusi = Institusi::where('uuid', $uuid)->firstOrFail();
        $institusi->delete();

        return redirect()->route('institusi.index')->with('success', 'Data Verifikasi Produk Institusi berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $exportDate = $request->input('export_date');

        if (!$exportDate) {
            return redirect()->back()->with('error', 'Tanggal export harus diisi.');
        }

        $data = Institusi::whereDate('date', $exportDate)->get();

        return Pdf::view('pdf.verifikasi-produk-institusi', [
            'tanggal'  => Carbon::parse($exportDate)->format('d/m/Y'),
            'data'     => $data,
            'shift'    => $data->isNotEmpty() ? $data->first()->shift : '-',
            'doc_code' => 'QR-3101',
        ])
        ->format('a4')
        ->name('verifikasi-produk-institusi-' . $exportDate . '.pdf');
    }
}
