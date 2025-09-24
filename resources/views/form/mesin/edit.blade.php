@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Edit Verifikasi Mesin</h4>
            <form method="POST" action="{{ route('mesin.update', $mesin->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- penting untuk update --}}

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input 
                                    type="date" 
                                    id="dateInput" 
                                    name="date" 
                                    class="form-control" 
                                    value="{{ old('date', $mesin->date) }}" 
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift', $mesin->shift) == '1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $mesin->shift) == '2' ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $mesin->shift) == '3' ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                  <div class="card-header bg-info text-white">
                    <strong>Pemeriksaan Verifikasi Mesin</strong>
                  </div>

                  <div class="card-body p-0">
                      <div class="table-responsive">
                          <table class="table table-bordered table-sm mb-0 text-center align-middle">
                              <thead class="table-light">
                                  <tr>
                                      <th>Nama Mesin</th>
                                      <th>Standar Setting</th>
                                      <th>Aktual</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @php 
                                      // Ambil data lama (array) agar bisa diulang
                                      $verif_mesin = json_decode($mesin->verif_mesin, true) ?? [];
                                  @endphp
                                  @for ($i = 0; $i < 5; $i++)
                                  <tr>
                                      <td>
                                          <select name="nama_mesin[{{ $i }}]" class="form-control form-control-sm">
                                              <option value="">-- Pilih Mesin --</option>
                                              @foreach($mesinList as $item)
                                                  <option value="{{ $item }}"
                                                    @if(!empty($verif_mesin[$i]['nama_mesin']) && $verif_mesin[$i]['nama_mesin'] == $item) selected @endif>
                                                    {{ $item }}
                                                  </option>
                                              @endforeach
                                          </select>
                                      </td>
                                      <td>
                                          <input 
                                            type="number" 
                                            name="standar_setting[{{ $i }}]" 
                                            class="form-control form-control-sm" 
                                            step="0.1" 
                                            value="{{ $verif_mesin[$i]['standar_setting'] ?? '' }}">
                                      </td>
                                      <td>
                                          <input 
                                            type="number" 
                                            name="aktual[{{ $i }}]" 
                                            class="form-control form-control-sm" 
                                            step="0.1" 
                                            value="{{ $verif_mesin[$i]['aktual'] ?? '' }}">
                                      </td>
                                  </tr>
                                  @endfor
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>

                {{-- Tindakan Perbaikan --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Tindakan Perbaikan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="tindakan_perbaikan" class="form-control" placeholder="Tuliskan Tindakan Perbaikan">{{ old('tindakan_perbaikan', $mesin->tindakan_perbaikan) }}</textarea>
                    </div>
                    <div class="card-header bg-light">
                        <strong>Keterangan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="keterangan" class="form-control" placeholder="Tuliskan keterangan">{{ old('keterangan', $mesin->keterangan) }}</textarea>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $mesin->catatan) }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('mesin.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery & Bootstrap-Select -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>

<style>
/* sama persis dengan form input */
.table {
  width: 100%;
  table-layout: auto;
}
.table th,
.table td {
  padding: 0.75rem 0.75rem;
  vertical-align: middle;
  font-size: 0.9rem;
}
.table input.form-control-sm {
  width: 100%;
  min-width: 80px;
  font-size: 0.9rem;
}
.input-group-sm > .form-control,
.input-group-sm > .input-group-text {
  height: calc(2em + 0.5rem + 2px);
  font-size: 0.9rem;
}
.table thead th {
  background-color: #f8f9fa;
  font-weight: 600;
  text-align: center;
}
.table-sm th, .table-sm td {
  padding: 0.5rem;
  vertical-align: middle;
}
.input-group-sm>.form-control,
.input-group-sm>.input-group-text {
  height: calc(1.5em + 0.5rem + 2px);
  font-size: 0.875rem;
}
</style>
@endsection
