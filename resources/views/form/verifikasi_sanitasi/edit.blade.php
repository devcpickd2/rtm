@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Edit Verifikasi Sanitasi</h4>
            <form method="POST" action="{{ route('verifikasi_sanitasi.update', $verifikasi_sanitasi->uuid) }}">
                @csrf
                @method('PUT') {{-- penting untuk update --}}

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" 
                                    value="{{ old('date', $verifikasi_sanitasi->date) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift',$verifikasi_sanitasi->shift)=='1'?'selected':'' }}>Shift 1</option>
                                    <option value="2" {{ old('shift',$verifikasi_sanitasi->shift)=='2'?'selected':'' }}>Shift 2</option>
                                    <option value="3" {{ old('shift',$verifikasi_sanitasi->shift)=='3'?'selected':'' }}>Shift 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pukul</label>
                                <input type="time" id="timeInput" name="pukul" class="form-control" 
                                    value="{{ old('pukul', $verifikasi_sanitasi->pukul) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Area</label>
                                <input type="text" id="area" name="area" class="form-control"
                                    value="{{ old('area', $verifikasi_sanitasi->area) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mesin</label>
                                <input type="text" id="mesin" name="mesin" class="form-control"
                                    value="{{ old('mesin', $verifikasi_sanitasi->mesin) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cleaning Agents</label>
                                <input type="text" id="cleaning_agents" name="cleaning_agents" class="form-control"
                                    value="{{ old('cleaning_agents', $verifikasi_sanitasi->cleaning_agents) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Keterangan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="keterangan" class="form-control" placeholder="Tuliskan keterangan">{{ old('keterangan', $verifikasi_sanitasi->keterangan) }}</textarea>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" placeholder="Tuliskan catatan jika ada">{{ old('catatan', $verifikasi_sanitasi->catatan) }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('verifikasi_sanitasi.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery dulu (wajib) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // kalau mau otomatis shift sesuai jam saat edit, boleh diaktifkan
        // kalau mau pakai value lama dari DB, biarkan kosong saja
    });
</script>
@endsection
