<?php

namespace App\Http\Controllers;

use App\Models\Retain;
use App\Models\Produk;
use Illuminate\Http\Request;

class RetainController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = retain::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('production_code', 'like', "%{$search}%");
            });
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.retain.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.retain.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username      = session('username', 'Putri');

        $request->validate([
            'date' => 'required|date',
            'plant' => 'required|string|max:255',
            'sample_type' => 'required|string|max:255',
            'sample_storage' => 'nullable|array',
            'description' => 'required|string|max:255',
            'production_code' => 'required|string|max:255',
            'best_before' => 'required|date',
            'quantity' => 'nullable|integer',
            'remarks' => 'nullable|string',
            'note' => 'nullable|string',
            'nama_warehouse' => 'required',
        ]);

        $data = $request->only([
            'date','plant','sample_type','sample_storage','description','production_code',
            'best_before','quantity','remarks','note', 'nama_warehouse'
        ]);

        $data['username'] = $username;
        $data['status_warehouse'] = "1";
        $data['status_spv'] = "0";

        $data['sample_storage'] = json_encode($request->input('sample_storage', []), JSON_UNESCAPED_UNICODE);

        Retain::create($data);

        return redirect()->route('retain.index')
        ->with('success', 'Data Retained Sample Report berhasil disimpan');
    }


    public function edit($uuid)
    {
        $retain = Retain::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        $selectedStorage = json_decode($retain->sample_storage, true) ?? [];

        return view('form.retain.edit', compact('retain', 'produks', 'selectedStorage'));
    }


    public function update(Request $request, $uuid)
    {
        $retain = Retain::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username', 'Harnis');

        $request->validate([
            'date' => 'required|date',
            'plant' => 'required|string|max:255',
            'sample_type' => 'required|string|max:255',
            'sample_storage' => 'nullable|array',
            'description' => 'required|string|max:255',
            'production_code' => 'required|string|max:255',
            'best_before' => 'required|date',
            'quantity' => 'nullable|integer',
            'remarks' => 'nullable|string',
            'note' => 'nullable|string',
            'nama_warehouse' => 'required',
        ]);

        $data = [
            'date'             => $request->date,
            'plant'            => $request->plant,
            'sample_type'      => $request->sample_type,
            'description'      => $request->description,
            'production_code'  => $request->production_code,
            'best_before'      => $request->best_before,
            'quantity'         => $request->quantity,
            'remarks'          => $request->remarks,
            'note'             => $request->note,
            'username_updated' => $username_updated,
            'nama_warehouse'   => $request->nama_warehouse,
            'sample_storage'   => json_encode($request->input('sample_storage', []), JSON_UNESCAPED_UNICODE),
        ];

        $retain->update($data);

        return redirect()->route('retain.index')
        ->with('success', 'Data Retained Sample Report berhasil diperbarui');
    }

    public function destroy(string $uuid)
    {
        $retain = Retain::where('uuid', $uuid)->firstOrFail();
        $retain->delete();

        return redirect()->route('retain.index')
        ->with('success', 'Data Retained Sample Report berhasil dihapus');
    }
}
