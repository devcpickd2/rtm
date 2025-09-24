@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Laboratory Sample Submission Report</h4>
            <form method="POST" action="{{ route('submission.update', $submission->uuid) }}">
                @csrf
                @method('PUT')

                {{-- Identitas Sample --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white"><strong>Identitas Sample</strong></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Plant</label>
                                <input type="text" name="plant" class="form-control" value="{{ old('plant', $submission->plant) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sample Type</label>
                                <input type="text" name="sample_type" class="form-control" value="{{ old('sample_type', $submission->sample_type) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Collection Date</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date', $submission->date) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sample Storage</label>
                                <select name="sample_storage[]" class="selectpicker" multiple data-live-search="true" title="-- Sample Storage --" data-width="100%">
                                    @foreach(['Frozen (≤ –18 °C)','Chilled (0-5°C)','Other'] as $storage)
                                        <option value="{{ $storage }}" 
                                            @if(in_array($storage, $sampleStorage ?? [])) selected @endif>{{ $storage }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label><strong><i>Lab. Test Request : </i></strong></label>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Microbiological</label>
                                <select name="lab_request_micro[]" class="selectpicker" multiple data-live-search="true" title="-- Microbiological --" data-width="100%">
                                    @foreach(['Antibiotic residues','Enterococcus','TPC','Salmonella','Coliform','Yeast & Mold','E. Coli','Clostridium','S. Aureus','Other'] as $micro)
                                        <option value="{{ $micro }}" 
                                            @if(in_array($micro, $sampleMicro ?? [])) selected @endif>{{ $micro }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Chemical</label>
                                <select name="lab_request_chemical[]" class="selectpicker" multiple data-live-search="true" title="-- Chemical --" data-width="100%">
                                    @foreach(['Pesticide residues','Peroxide Value','pH','Ash','Free Fatty Acid','Salinity','Protein','Moisture','Other'] as $chemical)
                                        <option value="{{ $chemical }}" 
                                            @if(in_array($chemical, $sampleChemical ?? [])) selected @endif>{{ $chemical }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submission LAB --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <strong>Submission LAB</strong>
                    </div>
                    <div class="card-body table-responsive" style="overflow-x:auto;">
                        <table class="table table-bordered table-sm text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th>Production Code</th>
                                    <th>Best Before</th>
                                    <th>Quantity (gr)</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 15; $i++)
                                <tr>
                                    <td class="col-nama">
                                        <input list="produkList" name="report[{{ $i }}][nama_produk]" class="form-control" placeholder="Ketik atau pilih produk..." value="{{ old('report.'.$i.'.nama_produk', $sampleData[$i]['nama_produk'] ?? '') }}">
                                        <datalist id="produkList">
                                            @foreach($produks as $produk)
                                                <option value="{{ $produk->nama_produk }}"></option>
                                            @endforeach
                                        </datalist>
                                    </td>
                                    <td><input type="text" name="report[{{ $i }}][kode_produksi]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.kode_produksi', $sampleData[$i]['kode_produksi'] ?? '') }}"></td>
                                    <td><input type="date" name="report[{{ $i }}][best_before]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.best_before', $sampleData[$i]['best_before'] ?? '') }}"></td>
                                    <td><input type="number" name="report[{{ $i }}][quantity]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.quantity', $sampleData[$i]['quantity'] ?? '') }}"></td>
                                    <td><input type="text" name="report[{{ $i }}][remark]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.remark', $sampleData[$i]['remark'] ?? '') }}"></td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto"><i class="bi bi-save"></i> Update</button>
                    <a href="{{ route('submission.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery, Bootstrap Select & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
        $('#nama_produk').select2({
            tags: true,
            placeholder: "Ketik atau pilih nama produk...",
            allowClear: true
        });
    });
</script>
@endsection
