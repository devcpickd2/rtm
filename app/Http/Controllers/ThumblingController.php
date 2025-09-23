<?php

namespace App\Http\Controllers;

use App\Models\Thumbling;
use App\Models\Produk;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;
use Carbon\Carbon;

class ThumblingController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Thumbling::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('thumbls', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.thumbling.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.thumbling.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');
        $nama_produksi = session('nama_produksi', 'Produksi RTM');

        $data = $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'catatan'     => 'nullable|string',
            'thumbls'     => 'nullable|array',

            // level batch
            'thumbls.*.batch' => 'nullable|string',
            'thumbls.*.daging'  => 'nullable|string',
            'thumbls.*.asal'  => 'nullable|string',

            // cukup cek array, jangan nested terlalu dalam
            'thumbls.*.kode_daging'    => 'nullable|array',
            'thumbls.*.bahan_utama'    => 'nullable|array',
            'thumbls.*.bahan_lain'     => 'nullable|array',
            'thumbls.*.hasil_tumbling' => 'nullable|array',

            // parameter tumbling
            'thumbls.*.air'           => 'nullable|string',
            'thumbls.*.suhu_air'      => 'nullable|string',
            'thumbls.*.suhu_marinade' => 'nullable|string',
            'thumbls.*.lama_pengadukan'=> 'nullable|string',
            'thumbls.*.brix'          => 'nullable|string',
            'thumbls.*.drum_on'       => 'nullable|string',
            'thumbls.*.drum_off'      => 'nullable|string',
            'thumbls.*.drum_speed'    => 'nullable|string',
            'thumbls.*.vacuum_time'   => 'nullable|string',
            'thumbls.*.total_time'    => 'nullable|string',
            'thumbls.*.mulai'         => 'nullable|string',
            'thumbls.*.selesai'       => 'nullable|string',

            // kondisi & catatan batch
            'thumbls.*.kondisi' => 'nullable|string',
            'thumbls.*.catatan' => 'nullable|string',
        ]);

        $data['username']        = $username;
        $data['nama_produksi']   = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv']      = "0";

        Thumbling::create($data);

        return redirect()->route('thumbling.index')
        ->with('success', 'Data Pemeriksaan Proses Thumbling berhasil disimpan');
    }

    public function edit($uuid)
    {
        $thumbling = Thumbling::where('uuid', $uuid)->firstOrFail();
        $produks   = Produk::all();
        $thumblsData = $thumbling->thumbls ?? [];

        return view('form.thumbling.edit', compact('thumbling', 'produks', 'thumblsData'));
    }

    public function update(Request $request, $uuid)
    {
        $thumbling = Thumbling::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $data = $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'catatan'     => 'nullable|string',
            'thumbls'     => 'nullable|array',
            'thumbls.*.batch' => 'nullable|string',
            'thumbls.*.daging'  => 'nullable|string',
            'thumbls.*.asal'  => 'nullable|string',
            'thumbls.*.kode_daging'    => 'nullable|array',
            'thumbls.*.bahan_utama'    => 'nullable|array',
            'thumbls.*.bahan_lain'     => 'nullable|array',
            'thumbls.*.hasil_tumbling' => 'nullable|array',
            'thumbls.*.air'           => 'nullable|string',
            'thumbls.*.suhu_air'      => 'nullable|string',
            'thumbls.*.suhu_marinade' => 'nullable|string',
            'thumbls.*.lama_pengadukan'=> 'nullable|string',
            'thumbls.*.brix'          => 'nullable|string',
            'thumbls.*.drum_on'       => 'nullable|string',
            'thumbls.*.drum_off'      => 'nullable|string',
            'thumbls.*.drum_speed'    => 'nullable|string',
            'thumbls.*.vacuum_time'   => 'nullable|string',
            'thumbls.*.total_time'    => 'nullable|string',
            'thumbls.*.mulai'         => 'nullable|string',
            'thumbls.*.selesai'       => 'nullable|string',
            'thumbls.*.kondisi' => 'nullable|string',
            'thumbls.*.catatan' => 'nullable|string',
        ]);

        $data['username_updated'] = $username_updated;
        $data['nama_produksi']    = $nama_produksi;

        $thumbling->update($data);

        return redirect()->route('thumbling.index')
        ->with('success', 'Data Pemeriksaan Proses Thumbling berhasil diperbarui');
    }
    
    public function destroy($uuid)
    {
        $thumbling = Thumbling::where('uuid', $uuid)->firstOrFail();
        $thumbling->delete();

        return redirect()->route('thumbling.index')->with('success', 'Data Pemeriksaan Proses Thumbling berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $exportDate = $request->input('export_date');

        if (!$exportDate) {
            return redirect()->back()->with('error', 'Tanggal export harus diisi.');
        }

        $data = Thumbling::whereDate('date', $exportDate)->get();

        return Pdf::view('pdf.pemeriksaan-tumbling', [
            'tanggal'  => Carbon::parse($exportDate)->format('d/m/Y'),
            'data'     => $data,
            'shift'    => $data->isNotEmpty() ? $data->first()->shift : '-',
            'produk'   => $data->isNotEmpty() ? $data->first()->nama_produk : '-',
            'doc_code' => 'QF 07/13',
        ])
        ->format('a4')
        ->name('pemeriksaan-tumbling-' . $exportDate . '.pdf');
    }
}
