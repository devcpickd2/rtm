@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Edit Laporan GMP Patrol</h4>
            <form method="POST" action="{{ route('gmp.update', $gmp->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Waktu Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control" 
                                    value="{{ old('date', $gmp->date) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <strong>Pemeriksaan Area</strong>
                    </div>
                    <div class="card-body">

                        {{-- Note --}}
                        <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Catatan:</strong>  
                            Kosongkan checkbox apabila <u>memakai lengkap</u>.  
                            <strong>Centang</strong> checkbox apabila <u>tidak memakai</u> atau <u>memakai namun tidak benar</u>.
                        </div>

                        {{-- Tabs --}}
                        <ul class="nav nav-tabs" id="areaTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#noodle-rice" type="button">
                                    Noodle & Rice
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cooking" type="button">
                                    Cooking
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#packing" type="button">
                                    Packing
                                </button>
                            </li>
                        </ul>

                        {{-- Isi Tab --}}
                        <div class="tab-content mt-3">

                            {{-- Noodle & Rice --}}
                            <div class="tab-pane fade show active" id="noodle-rice" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center align-middle compact-table">
                                        <thead class="table-info">
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Seragam</th>
                                                <th>Boot</th>
                                                <th>Masker</th>
                                                <th>Ciput</th>
                                                <th>Parfum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawanNoodle as $i => $nama_karyawan)
                                                @php
                                                    $row = $gmp->noodle_rice[$i] ?? [];
                                                @endphp
                                                <tr>
                                                    <td>{{ $nama_karyawan }}
                                                        <input type="hidden" name="noodle_rice[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                    </td>
                                                    @foreach(['seragam','boot','masker','ciput','parfum'] as $field)
                                                        <td>
                                                            <input type="hidden" name="noodle_rice[{{ $i }}][{{ $field }}]" value="0">
                                                            <input type="checkbox" name="noodle_rice[{{ $i }}][{{ $field }}]" value="1"
                                                                {{ (old("noodle_rice.$i.$field", $row[$field] ?? 0) == 1) ? 'checked' : '' }}>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Cooking --}}
                            <div class="tab-pane fade" id="cooking" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center align-middle compact-table">
                                        <thead class="table-warning">
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Seragam</th>
                                                <th>Boot</th>
                                                <th>Masker</th>
                                                <th>Ciput</th>
                                                <th>Parfum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawanCooking as $i => $nama_karyawan)
                                                @php
                                                    $row = $gmp->cooking[$i] ?? [];
                                                @endphp
                                                <tr>
                                                    <td>{{ $nama_karyawan }}
                                                        <input type="hidden" name="cooking[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                    </td>
                                                    @foreach(['seragam','boot','masker','ciput','parfum'] as $field)
                                                        <td>
                                                            <input type="hidden" name="cooking[{{ $i }}][{{ $field }}]" value="0">
                                                            <input type="checkbox" name="cooking[{{ $i }}][{{ $field }}]" value="1"
                                                                {{ (old("cooking.$i.$field", $row[$field] ?? 0) == 1) ? 'checked' : '' }}>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Packing --}}
                            <div class="tab-pane fade" id="packing" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center align-middle compact-table">
                                        <thead class="table-success">
                                            <tr>
                                                <th>Nama Karyawan</th>
                                                <th>Seragam</th>
                                                <th>Boot</th>
                                                <th>Masker</th>
                                                <th>Ciput</th>
                                                <th>Parfum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($karyawanPacking as $i => $nama_karyawan)
                                                @php
                                                    $row = $gmp->packing[$i] ?? [];
                                                @endphp
                                                <tr>
                                                    <td>{{ $nama_karyawan }}
                                                        <input type="hidden" name="packing[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                    </td>
                                                    @foreach(['seragam','boot','masker','ciput','parfum'] as $field)
                                                        <td>
                                                            <input type="hidden" name="packing[{{ $i }}][{{ $field }}]" value="0">
                                                            <input type="checkbox" name="packing[{{ $i }}][{{ $field }}]" value="1"
                                                                {{ (old("packing.$i.$field", $row[$field] ?? 0) == 1) ? 'checked' : '' }}>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="2">{{ old('catatan', $gmp->catatan) }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('gmp.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- CSS table compact --}}
<style>
    .compact-table td, .compact-table th {
        padding: 0.3rem !important;
        font-size: 0.85rem;
        line-height: 1.2;
    }
</style>
@endsection
