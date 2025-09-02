<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemens = Departemen::all();
        return view('form.departemen.index', compact('departemens'));
    }

    public function create()
    {
        return view('form.departemen.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);

        Departemen::create($request->all());

        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil ditambahkan');
    }

    public function edit(Departemen $departemen)
    {
        return view('form.departemen.edit', compact('departemen'));
    }

    public function update(Request $request, Departemen $departemen)
    {
        $departemen->update($request->only('nama'));
        return redirect()->route('departemen.index')->with('success', 'Update berhasil');
    }

    public function destroy($id)
    {
        $departemen = \App\Models\Departemen::find($id);

        if (!$departemen) {
            return redirect()->route('departemen.index')->with('error', 'Data tidak ditemukan');
        }

        $departemen->delete();
        return redirect()->route('departemen.index')->with('success', 'Departemen berhasil dihapus');
    }
}
