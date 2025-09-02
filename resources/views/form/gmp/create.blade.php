@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-plus-circle"></i> Form Input Laporan GMP Patrol</h4>
            <form method="POST" action="{{ route('gmp.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Waktu Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" required>
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

                        {{-- Note Petunjuk Checkbox --}}
                        <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Catatan:</strong>  
                            Kosongkan checkbox apabila <u>memakai lengkap</u>.  
                            <strong>Centang</strong> checkbox apabila <u>tidak memakai</u> atau <u>memakai namun tidak benar</u>.
                        </div>


                        {{-- Ribbon Menu --}}
                        <ul class="nav nav-tabs" id="areaTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="noodle-rice-tab" data-bs-toggle="tab" data-bs-target="#noodle-rice" type="button" role="tab">
                                    Noodle & Rice
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="cooking-tab" data-bs-toggle="tab" data-bs-target="#cooking" type="button" role="tab">
                                    Cooking
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="packing-tab" data-bs-toggle="tab" data-bs-target="#packing" type="button" role="tab">
                                    Packing
                                </button>
                            </li>
                        </ul>

                        {{-- Isi Tab --}}
                        <div class="tab-content mt-3" id="areaTabsContent">

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
                                            <tr>
                                                <td>{{ $nama_karyawan }}
                                                    <input type="hidden" name="noodle_rice[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="noodle_rice[{{ $i }}][seragam]" value="0">
                                                    <input type="checkbox" name="noodle_rice[{{ $i }}][seragam]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="noodle_rice[{{ $i }}][boot]" value="0">
                                                    <input type="checkbox" name="noodle_rice[{{ $i }}][boot]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="noodle_rice[{{ $i }}][masker]" value="0">
                                                    <input type="checkbox" name="noodle_rice[{{ $i }}][masker]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="noodle_rice[{{ $i }}][ciput]" value="0">
                                                    <input type="checkbox" name="noodle_rice[{{ $i }}][ciput]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="noodle_rice[{{ $i }}][parfum]" value="0">
                                                    <input type="checkbox" name="noodle_rice[{{ $i }}][parfum]" value="1">
                                                </td>
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
                                            <tr>
                                                <td>{{ $nama_karyawan }}
                                                    <input type="hidden" name="cooking[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="cooking[{{ $i }}][seragam]" value="0">
                                                    <input type="checkbox" name="cooking[{{ $i }}][seragam]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="cooking[{{ $i }}][boot]" value="0">
                                                    <input type="checkbox" name="cooking[{{ $i }}][boot]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="cooking[{{ $i }}][masker]" value="0">
                                                    <input type="checkbox" name="cooking[{{ $i }}][masker]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="cooking[{{ $i }}][ciput]" value="0">
                                                    <input type="checkbox" name="cooking[{{ $i }}][ciput]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="cooking[{{ $i }}][parfum]" value="0">
                                                    <input type="checkbox" name="cooking[{{ $i }}][parfum]" value="1">
                                                </td>
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
                                            <tr>
                                                <td>{{ $nama_karyawan }}
                                                    <input type="hidden" name="packing[{{ $i }}][nama_karyawan]" value="{{ $nama_karyawan }}">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="packing[{{ $i }}][seragam]" value="0">
                                                    <input type="checkbox" name="packing[{{ $i }}][seragam]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="packing[{{ $i }}][boot]" value="0">
                                                    <input type="checkbox" name="packing[{{ $i }}][boot]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="packing[{{ $i }}][masker]" value="0">
                                                    <input type="checkbox" name="packing[{{ $i }}][masker]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="packing[{{ $i }}][ciput]" value="0">
                                                    <input type="checkbox" name="packing[{{ $i }}][ciput]" value="1">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="packing[{{ $i }}][parfum]" value="0">
                                                    <input type="checkbox" name="packing[{{ $i }}][parfum]" value="1">
                                                </td>
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
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Tambahkan catatan bila ada"></textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('gmp.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Script untuk set waktu & shift otomatis --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");
        const timeInput = document.getElementById("timeInput");
        const shiftInput = document.getElementById("shiftInput");

        let now = new Date();
        let yyyy = now.getFullYear();
        let mm = String(now.getMonth() + 1).padStart(2, '0');
        let dd = String(now.getDate()).padStart(2, '0');
        let hh = String(now.getHours()).padStart(2, '0');
        let min = String(now.getMinutes()).padStart(2, '0');

        dateInput.value = `${yyyy}-${mm}-${dd}`;
        timeInput.value = `${hh}:${min}`;

        let hour = parseInt(hh);
        if (hour >= 7 && hour < 15) {
            shiftInput.value = "1";
        } else if (hour >= 15 && hour < 23) {
            shiftInput.value = "2";
        } else {
            shiftInput.value = "3"; 
        }
    });
</script>

{{-- CSS khusus untuk tabel lebih rapat --}}
<style>
    .compact-table td, .compact-table th {
        padding: 0.3rem !important;
        font-size: 0.85rem;
        line-height: 1.2;
    }
</style>
@endsection
