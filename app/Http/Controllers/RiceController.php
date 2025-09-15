<?php

namespace App\Http\Controllers;

use App\Models\Rice;
use App\Models\Produk;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;
use Carbon\Carbon;

class RiceController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Rice::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('cooker', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.rice.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.rice.create', compact('produks'));
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
            'cooker'      => 'nullable|array',
        ]);

        $data = $request->only(['date', 'shift', 'nama_produk', 'catatan']);
        $data['username']        = $username;
        $data['nama_produksi']   = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv']      = "0";

        // Konversi cooker ke JSON
        $data['cooker'] = json_encode($request->input('cooker', []), JSON_UNESCAPED_UNICODE);

        Rice::create($data);

        return redirect()->route('rice.index')
        ->with('success', 'Data Pemeriksaan Pemasakan dengan rice berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $data = Rice::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

    // Decode JSON menjadi array
        $cookerData = !empty($data->cooker) ? json_decode($data->cooker, true) : [];

        return view('form.rice.edit', compact('data', 'produks', 'cookerData'));
    }

    public function update(Request $request, string $uuid)
    {
        $rice = Rice::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'catatan'     => 'nullable|string',
            'cooker'      => 'nullable|array',
        ]);

        $data = [
            'date'             => $request->date,
            'shift'            => $request->shift,
            'nama_produk'      => $request->nama_produk,
            'catatan'          => $request->catatan,
            'username_updated' => $username_updated,
            'nama_produksi'    => $nama_produksi,
            'cooker'          => json_encode($request->input('cooker', []), JSON_UNESCAPED_UNICODE),
        ];

        $rice->update($data);

        return redirect()->route('rice.index')
        ->with('success', 'Data Pemeriksaan Pemasakan dengan Rice Cooker berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $rice = Rice::where('uuid', $uuid)->firstOrFail();
        $rice->delete();

        return redirect()->route('rice.index')
        ->with('success', 'Data Pemeriksaan Pemasakan dengan Rice Cooker berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $exportDate = $request->input('export_date');

        if (!$exportDate) {
            return redirect()->back()->with('error', 'Tanggal export harus diisi.');
        }

        $data = Rice::whereDate('date', $exportDate)->get();

        return Pdf::view('pdf.pemeriksaan-rice-cooker', [
            'tanggal'  => Carbon::parse($exportDate)->format('d/m/Y'),
            'data'     => $data,
            'shift'    => $data->isNotEmpty() ? $data->first()->shift : '-',
            'produk'   => $data->isNotEmpty() ? $data->first()->nama_produk : '-',
            'doc_code' => 'QF 07/08',
        ])
        ->format('a4')
        ->name('pemeriksaan-rice-cooker-' . $exportDate . '.pdf');
    }
}
