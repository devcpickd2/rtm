<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suhu;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Default tanggal hari ini
        $tanggal = $request->input('tanggal', Carbon::today()->toDateString());

        // Ambil data suhu
        $data = Suhu::whereDate('date', $tanggal)
                    ->orderBy('pukul', 'asc')
                    ->get();

        // Ambil daftar produksi jika belum dipilih
        if (!session()->has('selected_produksi')) {
            $produksi = User::where('type_user', 3)->get();
            session(['pop_up_produksi' => $produksi]);
        }

        return view('dashboard', compact('data', 'tanggal'));
    }

    public function setProduksi(Request $request)
    {
        $request->validate([
            'nama_produksi' => 'required|exists:users,uuid',
        ]);

        $produksi = User::where('uuid', $request->nama_produksi)->first();
        if ($produksi) {
            session(['selected_produksi' => $produksi->uuid]);
        }

        session()->forget('pop_up_produksi');

        return redirect()->route('dashboard');
    }
}
