<?php

namespace App\Http\Controllers;

use App\Models\Noodle;
use App\Models\Produk;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;
use Carbon\Carbon;

class NoodleController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Noodle::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('nama_produk', 'like', "%{$search}%")
            ->orWhere('mixing', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.noodle.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.noodle.create', compact('produks'));
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

            //atribut Mixing
            'mixing'      => 'nullable|array',
            // level batch
            'mixing.*.nama_produk'   => 'nullable|string',
            'mixing.*.kode_produksi' => 'nullable|string',
            //mixing
            'mixing.*.bahan_utama'  => 'nullable|string',
            'mixing.*.kode_bahan'   => 'nullable|string',
            'mixing.*.berat_bahan'  => 'nullable|string',
            //array bahan lain
            'mixing.*.bahan_lain'     => 'nullable|array',
            'mixing.*.waktu_proses'   => 'nullable|array',
            'mixing.*.vacuum'         => 'nullable|array',
            'mixing.*.suhu_adonan'    => 'nullable|array',
            //array aging
            'mixing.*.waktu_aging'     => 'nullable|array',
            'mixing.*.rh_aging'        => 'nullable|array',
            'mixing.*.suhu_ruang_aging'=> 'nullable|array',
            //rolling
            'mixing.*.tebal_rolling'        => 'nullable|array',
            //cutting
            'mixing.*.sampling_cutiing'     => 'nullable|array',
             //boiling
            'mixing.*.suhu_setting_boiling' => 'nullable|string',
            'mixing.*.suhu_actual_boiling'  => 'nullable|array',
            'mixing.*.waktu_boiling'        => 'nullable|string',
            //washing
            'mixing.*.suhu_setting_washing' => 'nullable|string',
            'mixing.*.suhu_actual_washing'  => 'nullable|array',
            'mixing.*.waktu_washing'        => 'nullable|string',
            //cooling shock
            'mixing.*.suhu_setting_cooling' => 'nullable|string',
            'mixing.*.suhu_actual_cooling'  => 'nullable|array',
            'mixing.*.waktu_cooling'        => 'nullable|string',
            // lama proses
            'mixing.*.mulai'         => 'nullable|string',
            'mixing.*.selesai'       => 'nullable|string',
            //sensori
            'mixing.*.suhu_akhir'   => 'nullable|array',
            'mixing.*.suhu_after'   => 'nullable|array',
            'mixing.*.rasa'         => 'nullable|array',
            'mixing.*.kekenyalan'   => 'nullable|array',
            'mixing.*.warna'        => 'nullable|array',
        ]);

        $data['username']        = $username;
        $data['nama_produksi']   = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv']      = "0";

        Noodle::create($data);

        return redirect()->route('noodle.index')
        ->with('success', 'Data Pemeriksaan Pemasakan Noodle berhasil disimpan');
    }

    public function edit($uuid)
    {
        $noodle = Noodle::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        if (is_array($noodle->mixing)) {
            $mixing = $noodle->mixing;
        } else {
            $mixing = json_decode($noodle->mixing, true) ?? [];
        }

        return view('form.noodle.edit', compact('noodle', 'produks', 'mixing'));
    }

    public function update(Request $request, $uuid)
    {
        $noodle = Noodle::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi    = session('nama_produksi', 'Produksi RTM');

        $data = $request->validate([
            'date'        => 'required|date',
            'shift'       => 'required',
            'nama_produk' => 'required',
            'catatan'     => 'nullable|string',

            //atribut Mixing
            'mixing'      => 'nullable|array',
            // level batch
            'mixing.*.nama_produk'   => 'nullable|string',
            'mixing.*.kode_produksi' => 'nullable|string',
            //mixing
            'mixing.*.bahan_utama'  => 'nullable|string',
            'mixing.*.kode_bahan'   => 'nullable|string',
            'mixing.*.berat_bahan'  => 'nullable|string',
            //array bahan lain
            'mixing.*.bahan_lain'     => 'nullable|array',
            'mixing.*.waktu_proses'   => 'nullable|array',
            'mixing.*.vacuum'         => 'nullable|array',
            'mixing.*.suhu_adonan'    => 'nullable|array',
            //array aging
            'mixing.*.waktu_aging'     => 'nullable|array',
            'mixing.*.rh_aging'        => 'nullable|array',
            'mixing.*.suhu_ruang_aging'=> 'nullable|array',
            //rolling
            'mixing.*.tebal_rolling'        => 'nullable|array',
            //cutting
            'mixing.*.sampling_cutiing'     => 'nullable|array',
             //boiling
            'mixing.*.suhu_setting_boiling' => 'nullable|string',
            'mixing.*.suhu_actual_boiling'  => 'nullable|array',
            'mixing.*.waktu_boiling'        => 'nullable|string',
            //washing
            'mixing.*.suhu_setting_washing' => 'nullable|string',
            'mixing.*.suhu_actual_washing'  => 'nullable|array',
            'mixing.*.waktu_washing'        => 'nullable|string',
            //cooling shock
            'mixing.*.suhu_setting_cooling' => 'nullable|string',
            'mixing.*.suhu_actual_cooling'  => 'nullable|array',
            'mixing.*.waktu_cooling'        => 'nullable|string',
            // lama proses
            'mixing.*.mulai'         => 'nullable|string',
            'mixing.*.selesai'       => 'nullable|string',
            //sensori
            'mixing.*.suhu_akhir'   => 'nullable|array',
            'mixing.*.suhu_after'   => 'nullable|array',
            'mixing.*.rasa'         => 'nullable|array',
            'mixing.*.kekenyalan'   => 'nullable|array',
            'mixing.*.warna'        => 'nullable|array',
        ]);

        $data['username_updated'] = $username_updated;
        $data['nama_produksi']    = $nama_produksi;

        $noodle->update($data);

        return redirect()->route('noodle.index')
        ->with('success', 'Data Pemeriksaan Pemasakan noodle berhasil diperbarui');
    }
    
    public function destroy($uuid)
    {
        $noodle = Noodle::where('uuid', $uuid)->firstOrFail();
        $noodle->delete();

        return redirect()->route('noodle.index')->with('success', 'Data Pemeriksaan Pemasakan Noodle berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $exportDate = $request->input('export_date');

        if (!$exportDate) {
            return redirect()->back()->with('error', 'Tanggal export harus diisi.');
        }

        $data = Noodle::whereDate('date', $exportDate)->get();

        return Pdf::view('pdf.pemeriksaan-noodle', [
            'tanggal'  => Carbon::parse($exportDate)->format('d/m/Y'),
            'data'     => $data,
            'shift'    => $data->isNotEmpty() ? $data->first()->shift : '-',
            'produk'   => $data->isNotEmpty() ? $data->first()->nama_produk : '-',
            'doc_code' => 'QF 07/09',
        ])
        ->format('a4')
        ->name('pemeriksaan-noodle-' . $exportDate . '.pdf');
    }
}
