@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-plus-circle"></i> Form Input Laboratory Sample Submission Report</h4>
            <form method="POST" action="{{ route('submission.store') }}">
                @csrf

                {{-- Identitas Sample --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white"><strong>Identitas Sample</strong></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Plant</label>
                                <input type="text" name="plant" class="form-control" value="Cikande 2 Ready Meal" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sample Type</label>
                                <input type="text" name="sample_type" class="form-control" value="{{ old('sample_type', $data->sample_type ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Collection Date</label>
                                <input type="date" id="dateInput" name="date" class="form-control" value="{{ old('date', $data->date ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                              <label class="form-label">Sample Storage</label>
                              <select id="sample_storage" name="sample_storage[]" 
                              class="selectpicker" 
                              multiple 
                              data-live-search="true"
                              title="-- Sample Storage --"
                              data-width="100%">
                              <option value="Frozen (≤ –18 °C)">Frozen (≤ –18 °C)</option>
                              <option value="Chilled (0-5°C)">Chilled (0-5°C)</option>
                              <option value="Other">Other</option>
                          </select>
                      </div>
                  </div>
                  <label><strong><i>Lab. Test Request : </i></strong></label>
                  <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Microbiological</label>
                        <select id="lab_request_micro" name="lab_request_micro[]" 
                        class="selectpicker" 
                        multiple 
                        data-live-search="true"
                        title="-- Microbiological --"
                        data-width="100%">
                        <option value="Antibiotic residues">Antibiotic residues</option>
                        <option value="Enterococcus">Enterococcus</option>
                        <option value="TPC">TPC</option>
                        <option value="Salmonella">Salmonella</option>
                        <option value="Coliform">Coliform</option>
                        <option value="Yeast & Mold">Yeast & Mold</option>
                        <option value="E. Coli">E. Coli</option>
                        <option value="Clostridium">Clostridium</option>
                        <option value="S. Aureus">S. Aureus</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Chemical</label>
                    <select id="lab_request_chemical" name="lab_request_chemical[]" 
                    class="selectpicker" 
                    multiple 
                    data-live-search="true"
                    title="-- Chemical --"
                    data-width="100%">
                    <option value="Pesticide residues">Pesticide residues</option>
                    <option value="Peroxide Value">Peroxide Value</option>
                    <option value="pH">pH</option>
                    <option value="Ash">Ash</option>
                    <option value="Free Fatty Acid">Free Fatty Acid</option>
                    <option value="Salinity">Salinity</option>
                    <option value="Protein">Protein</option>
                    <option value="Moisture">Moisture</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <strong>Submission LAB</strong>
    </div>
    <div class="card-body table-responsive" style="overflow-x:auto;">
        <table class="table table-bordered table-sm text-center align-middle" id="sampleTable">
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
                        <input list="produkList" name="report[{{ $i }}][nama_produk]" 
                        class="form-control" placeholder="Ketik atau pilih produk..." 
                        value="{{ old('report.'.$i.'.nama_produk', $data->report[$i]['nama_produk'] ?? '') }}">
                        <datalist id="produkList">
                            @foreach($produks as $produk)
                            <option value="{{ $produk->nama_produk }}"></option>
                            @endforeach
                        </datalist>
                    </td>
                    <td><input type="text" name="report[{{ $i }}][kode_produksi]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.kode_produksi', $data->report[$i]['kode_produksi'] ?? '') }}"></td>
                    <td><input type="date" name="report[{{ $i }}][best_before]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.best_before', $data->report[$i]['best_before'] ?? '') }}"></td>
                    <td><input type="number" name="report[{{ $i }}][quantity]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.quantity', $data->report[$i]['quantity'] ?? '') }}"></td>
                    <td><input type="text" name="report[{{ $i }}][remark]" class="form-control form-control-sm" value="{{ old('report.'.$i.'.remark', $data->report[$i]['remark'] ?? '') }}"></td>
                </tr>
                @endfor
            </tbody>

        </table>
    </div>
</div>

{{-- Tombol Simpan --}}
<div class="d-flex justify-content-between mt-3">
    <button class="btn btn-success w-auto"><i class="bi bi-save"></i> Simpan</button>
    <a href="{{ route('submission.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
</form>
</div>
</div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Bootstrap-Select CSS & JS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>

<script>
    $(document).ready(function() {
        $('#nama_produk').select2({
        tags: true, // <-- ini yang bikin bisa input manual
        placeholder: "Ketik atau pilih nama produk...",
        allowClear: true
    });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");

    // Ambil waktu sekarang
        let now = new Date();
        let yyyy = now.getFullYear();
        let mm = String(now.getMonth() + 1).padStart(2, '0');
        let dd = String(now.getDate()).padStart(2, '0');
        let hh = String(now.getHours()).padStart(2, '0');
        let min = String(now.getMinutes()).padStart(2, '0');

    // Set value tanggal dan jam
        dateInput.value = `${yyyy}-${mm}-${dd}`;

    });
</script>
<style>
/* Scroll horizontal */
.table-responsive {
  overflow-x: auto;
}

/* Umum */
.table {
  width: 100%;
  table-layout: auto;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: middle;
  font-size: 0.9rem;
  text-align: center;
}

/* Select/Input full width */
.table td select.form-select,
.table td input.form-control-sm {
  width: 100%;
  font-size: 0.9rem;
}

/* === Lebar Kolom === */
.col-nama {
  min-width: 300px; /* Nama Produk paling lebar */
}

.col-kode {
  min-width: 250px; /* Kode Produksi lebar */
}

.col-standar {
    min-width: 150px; /* Standar Suhu kecil */
}

.col-cek {
  min-width: 100px; /* Cek suhu & Rata2 kecil */
}

.col-ket {
  min-width: 200px; /* Keterangan lebar lagi */
}

/* Header */
.table thead th {
  background-color: #f8f9fa;
  font-weight: 600;
}

/* Selectpicker full width */
.bootstrap-select .dropdown-toggle {
  width: 100% !important;
}
</style>
@endsection
