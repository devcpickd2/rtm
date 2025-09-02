@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Edit Sortasi Bahan Baku yang Tidak Sesuai</h4>
            <form method="POST" action="{{ route('sortasi.update', $sortasi->uuid) }}" enctype="multipart/form-data">
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
                                <input type="date" id="dateInput" name="date" class="form-control" value="{{ $sortasi->date }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ $sortasi->shift == 1 ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ $sortasi->shift == 2 ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ $sortasi->shift == 3 ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Sortasi Bahan Baku</strong>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Bahan</label>
                                <input type="text" id="nama_bahan" name="nama_bahan" class="form-control" value="{{ $sortasi->nama_bahan }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kode Produksi</label>
                                <input type="text" id="kode_produksi" name="kode_produksi" class="form-control" value="{{ $sortasi->kode_produksi }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Jumlah Bahan Sebelum Sortasi</label>
                                <input type="number" id="jumlah_bahan" name="jumlah_bahan" class="form-control" value="{{ $sortasi->jumlah_bahan }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jumlah Bahan Sesuai</label>
                                <input type="number" id="jumlah_sesuai" name="jumlah_sesuai" class="form-control" value="{{ $sortasi->jumlah_sesuai }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jumlah Bahan Tidak Sesuai</label>
                                <input type="number" id="jumlah_tidak_sesuai" name="jumlah_tidak_sesuai" class="form-control" value="{{ $sortasi->jumlah_tidak_sesuai }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Tindakan Koreksi</label>
                                <textarea name="tindakan_koreksi" class="form-control" rows="3" placeholder="Tulis tindakan koreksi">{{ $sortasi->tindakan_koreksi }}</textarea>
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
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ $sortasi->catatan }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('sortasi.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
