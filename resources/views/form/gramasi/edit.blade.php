@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Form Edit Verifikasi Gramasi Topping</h4>
            <form method="POST" action="{{ route('gramasi.update', $gramasi->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" 
                                    value="{{ old('date', $gramasi->date) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift', $gramasi->shift) == 1 ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $gramasi->shift) == 2 ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $gramasi->shift) == 3 ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <select id="nama_produk" name="nama_produk" class="form-control selectpicker" 
                                    data-live-search="true" title="Ketik nama produk..." required>
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->nama_produk }}"
                                        {{ old('nama_produk', $gramasi->nama_produk) == $produk->nama_produk ? 'selected' : '' }}>
                                        {{ $produk->nama_produk }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kode Produksi</label>
                                <input type="text" id="kode_produksi" name="kode_produksi" class="form-control"
                                    value="{{ old('kode_produksi', $gramasi->kode_produksi) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <strong>Pemeriksaan Gramasi</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0 text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="8">Berat Topping Aktual (gram)</th>
                                    </tr>
                                    <tr>
                                        <th>Jenis Topping</th>
                                        <th>Standar (gram)</th>
                                        <th>Pukul</th>
                                        <th>Gramasi</th>
                                        <th>Pukul</th>
                                        <th>Gramasi</th>
                                        <th>Pukul</th>
                                        <th>Gramasi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $rows = max(count($gramasi_toppingData), 6); // minimal 6 baris
                                    @endphp
                                    @for ($i = 0; $i < $rows; $i++)
                                    <tr>
                                        <td>
                                            <input type="text" name="jenis_topping[{{ $i }}]" class="form-control form-control-sm"
                                                value="{{ $gramasi_toppingData[$i]['jenis_topping'] ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="number" name="standar[{{ $i }}]" class="form-control form-control-sm" step="0.1"
                                                value="{{ $gramasi_toppingData[$i]['standar'] ?? '' }}">
                                        </td>
                                        @if($i == 0)
                                        <td rowspan="{{ $rows }}">
                                            <input type="time" name="pukul_1" class="form-control form-control-sm"
                                                value="{{ $gramasi_toppingData[0]['pukul_1'] ?? '' }}">
                                        </td>
                                        @endif
                                        <td>
                                            <input type="number" name="gramasi_1[{{ $i }}]" class="form-control form-control-sm" step="0.1"
                                                value="{{ $gramasi_toppingData[$i]['gramasi_1'] ?? '' }}">
                                        </td>
                                        @if($i == 0)
                                        <td rowspan="{{ $rows }}">
                                            <input type="time" name="pukul_2" class="form-control form-control-sm"
                                                value="{{ $gramasi_toppingData[0]['pukul_2'] ?? '' }}">
                                        </td>
                                        @endif
                                        <td>
                                            <input type="number" name="gramasi_2[{{ $i }}]" class="form-control form-control-sm" step="0.1"
                                                value="{{ $gramasi_toppingData[$i]['gramasi_2'] ?? '' }}">
                                        </td>
                                        @if($i == 0)
                                        <td rowspan="{{ $rows }}">
                                            <input type="time" name="pukul_3" class="form-control form-control-sm"
                                                value="{{ $gramasi_toppingData[0]['pukul_3'] ?? '' }}">
                                        </td>
                                        @endif
                                        <td>
                                            <input type="number" name="gramasi_3[{{ $i }}]" class="form-control form-control-sm" step="0.1"
                                                value="{{ $gramasi_toppingData[$i]['gramasi_3'] ?? '' }}">
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $gramasi->catatan) }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('gramasi.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery dulu (wajib) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap-Select CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>

<style>
/* sama seperti create */
.table { width: 100%; table-layout: auto; }
.table th, .table td { padding: 0.75rem; vertical-align: middle; font-size: 0.9rem; }
.table input.form-control-sm { width: 100%; min-width: 80px; font-size: 0.9rem; }
.input-group-sm>.form-control, .input-group-sm>.input-group-text { height: calc(1.5em + 0.5rem + 2px); font-size: 0.875rem; }
.table thead th { background-color: #f8f9fa; font-weight: 600; text-align: center; }
</style>
@endsection
