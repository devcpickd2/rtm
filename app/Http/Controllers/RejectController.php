<?php

namespace App\Http\Controllers;

use App\Models\Reject;
use App\Models\Metal;
use App\Models\Xray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RejectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $data = Reject::query()
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

        return view('form.reject.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
    // Ambil semua kombinasi yang sudah ada di reject
        $existingRejects = Reject::select('nama_produk', 'kode_produksi', 'nama_mesin')->get();

    // FILTER untuk Metal Detector
        $metalProducts = Metal::all()
        ->filter(function ($m) use ($existingRejects) {
            // cek apakah kombinasi sudah ada di reject dengan nama_mesin Metal Detector
            return !$existingRejects->contains(function ($item) use ($m) {
                return $item->nama_produk === $m->nama_produk &&
                $item->kode_produksi === $m->kode_produksi &&
                $item->nama_mesin === 'Metal Detector';
            });
        })
        ->map(function ($m) {
            return [
                'nama_produk'   => $m->nama_produk,
                'kode_produksi' => $m->kode_produksi,
            ];
        })
        ->values()
        ->toArray();

    // FILTER untuk X-Ray
        $xrayProducts = Xray::all()
        ->filter(function ($x) use ($existingRejects) {
            // cek apakah kombinasi sudah ada di reject dengan nama_mesin X-Ray
            return !$existingRejects->contains(function ($item) use ($x) {
                return $item->nama_produk === $x->nama_produk &&
                $item->kode_produksi === $x->kode_produksi &&
                $item->nama_mesin === 'X-Ray';
            });
        })
        ->map(function ($x) {
            return [
                'nama_produk'   => $x->nama_produk,
                'kode_produksi' => $x->kode_produksi,
            ];
        })
        ->values()
        ->toArray();

        return view('form.reject.create', compact('metalProducts', 'xrayProducts'));
    }

    public function store(Request $request)
    {
        $username = session('username', 'Putri');
        $nama_produksi = 'Produksi RTM';

        // Fungsi untuk membersihkan spasi berlebih
        $cleanString = fn($str) => is_string($str) ? trim(preg_replace('/\s+/', ' ', $str)) : $str;

        $request->validate([
            'date' => 'required|date',
            'shift' => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'nama_mesin' => 'required',
            'jumlah_tidak_lolos' => 'nullable|integer',
            'jumlah_kontaminan' => 'nullable|integer',
            'jenis_kontaminan' => 'nullable|string',
            'posisi_kontaminan' => 'nullable|string',
            'false_rejection' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift', 'nama_produk', 'kode_produksi', 'nama_mesin',
            'jumlah_tidak_lolos', 'jumlah_kontaminan', 'jenis_kontaminan',
            'posisi_kontaminan', 'false_rejection', 'catatan'
        ]);

        // Bersihkan data sebelum disimpan ke database
        $data['nama_produk'] = $cleanString($data['nama_produk']);
        $data['kode_produksi'] = $cleanString($data['kode_produksi']);
        $data['username'] = $username;
        $data['nama_produksi'] = $nama_produksi;
        $data['status_produksi'] = "1";
        $data['status_spv'] = "0";

        Reject::create($data);

        return redirect()->route('reject.index')->with('success', 'Data Monitoring False Rejection berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $reject = Reject::where('uuid', $uuid)->firstOrFail();
        return view('form.reject.edit', compact('reject'));
    }

    public function update(Request $request, string $uuid)
    {
        $reject = Reject::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');
        $nama_produksi = 'Produksi RTM';

        // Fungsi untuk membersihkan spasi berlebih
        $cleanString = fn($str) => is_string($str) ? trim(preg_replace('/\s+/', ' ', $str)) : $str;

        $request->validate([
            'date' => 'required|date',
            'shift' => 'required',
            'nama_produk' => 'required',
            'kode_produksi' => 'required',
            'nama_mesin' => 'required',
            'jumlah_tidak_lolos' => 'nullable|integer',
            'jumlah_kontaminan' => 'nullable|integer',
            'jenis_kontaminan' => 'nullable|string',
            'posisi_kontaminan' => 'nullable|string',
            'false_rejection' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only([
            'date', 'shift', 'nama_produk', 'kode_produksi', 'nama_mesin',
            'jumlah_tidak_lolos', 'jumlah_kontaminan', 'jenis_kontaminan',
            'posisi_kontaminan', 'false_rejection', 'catatan'
        ]);

        // Bersihkan data sebelum diperbarui
        $data['nama_produk'] = $cleanString($data['nama_produk']);
        $data['kode_produksi'] = $cleanString($data['kode_produksi']);
        $data['username_updated'] = $username_updated;
        $data['nama_produksi'] = $nama_produksi;

        $reject->update($data);

        return redirect()->route('reject.index')->with('success', 'Data Monitoring False Rejection berhasil diperbarui');
    }

    public function destroy(string $uuid)
    {
        $reject = Reject::where('uuid', $uuid)->firstOrFail();
        $reject->delete();

        return redirect()->route('reject.index')->with('success', 'Data Monitoring False Rejection berhasil dihapus');
    }
}
