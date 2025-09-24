<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Produk;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $data = Submission::query()
        ->when($search, function ($query) use ($search) {
            $query->where('username', 'like', "%{$search}%")
            ->orWhere('plant', 'like', "%{$search}%")
            ->orWhere('sample_type', 'like', "%{$search}%");
        })
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
            $query->whereBetween('date', [$start_date, $end_date]);
        })
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends($request->all());

        return view('form.submission.index', compact('data', 'search', 'start_date', 'end_date'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('form.submission.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $username = session('username', 'Putri');

        $request->validate([
            'date' => 'required|date',
            'sample_type' => 'required',
            'plant' => 'required',
            'sample_storage' => 'nullable|array',
            'lab_request_micro' => 'nullable|array',
            'lab_request_chemical' => 'nullable|array',
            'report' => 'nullable|array',
        ]);

        $data = $request->only(['date', 'sample_type', 'plant']);
        $data['username'] = $username;
        $data['status_spv'] = "0";

        $data['sample_storage'] = json_encode($request->input('sample_storage', []), JSON_UNESCAPED_UNICODE);
        $data['lab_request_micro'] = json_encode($request->input('lab_request_micro', []), JSON_UNESCAPED_UNICODE);
        $data['lab_request_chemical'] = json_encode($request->input('lab_request_chemical', []), JSON_UNESCAPED_UNICODE);

    // Filter report, hanya simpan baris yang diisi
        $report = $request->input('report', []);
        $report = array_filter($report, function($row) {
            return !empty(array_filter($row)); 
        });
        
        $data['report'] = json_encode($report, JSON_UNESCAPED_UNICODE);

        Submission::create($data);

        return redirect()->route('submission.index')
        ->with('success', 'Data Laboratory Sample Submission Report berhasil disimpan');
    }

    public function edit(string $uuid)
    {
        $submission = Submission::where('uuid', $uuid)->firstOrFail();
        $produks = Produk::all();

        $sampleStorage = !empty($submission->sample_storage) ? json_decode($submission->sample_storage, true) : [];
        $sampleData = !empty($submission->report) ? json_decode($submission->report, true) : [];
        $sampleMicro = !empty($submission->lab_request_micro) ? json_decode($submission->lab_request_micro, true) : [];
        $sampleChemical = !empty($submission->lab_request_chemical) ? json_decode($submission->lab_request_chemical, true) : [];

        return view('form.submission.edit', compact('submission', 'produks', 'sampleData', 'sampleStorage', 'sampleMicro', 'sampleChemical'));
    }

    public function update(Request $request, string $uuid)
    {
        $submission = Submission::where('uuid', $uuid)->firstOrFail();
        $username_updated = session('username_updated', 'Harnis');

        $request->validate([
            'date' => 'required|date',
            'sample_type' => 'required',
            'plant' => 'required',
            'sample_storage' => 'nullable|array',
            'lab_request_micro' => 'nullable|array',
            'lab_request_chemical' => 'nullable|array',
            'report' => 'nullable|array',
        ]);

        $sample_storage = $request->input('sample_storage', []);
        $report = $request->input('report', []);
        $lab_request_micro = $request->input('lab_request_micro', []);
        $lab_request_chemical = $request->input('lab_request_chemical', []);

    // Filter report, hanya simpan baris yang diisi
        $report = array_filter($report, function($row) {
            return !empty(array_filter($row));
        });

        $data = [
            'date' => $request->date,
            'sample_type' => $request->sample_type,
            'plant' => $request->plant,
            'username_updated' => $username_updated,
            'sample_storage' => json_encode($sample_storage, JSON_UNESCAPED_UNICODE),
            'report' => json_encode($report, JSON_UNESCAPED_UNICODE),
            'lab_request_micro' => json_encode($lab_request_micro, JSON_UNESCAPED_UNICODE),
            'lab_request_chemical' => json_encode($lab_request_chemical, JSON_UNESCAPED_UNICODE),
        ];

        $submission->update($data);

        return redirect()->route('submission.index')->with('success', 'Data Laboratory Sample Submission Report berhasil diperbarui');
    }

    public function destroy($uuid)
    {
        $submission = Submission::where('uuid', $uuid)->firstOrFail();
        $submission->delete();

        return redirect()->route('submission.index')
        ->with('success', 'Data Laboratory Sample Submission Report berhasil dihapus');
    }
}
