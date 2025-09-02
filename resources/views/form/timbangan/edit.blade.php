@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Edit Peneraan Timbangan</h4>
            <form method="POST" action="{{ route('timbangan.update', $timbangan->uuid) }}" enctype="multipart/form-data">
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
                                <input type="date" id="dateInput" name="date" 
                                       class="form-control" 
                                       value="{{ old('date', $timbangan->date) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift', $timbangan->shift) == 1 ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $timbangan->shift) == 2 ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $timbangan->shift) == 3 ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Peneraan Timbangan</strong>
                    </div>

                    {{-- Notes --}}
                    <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Catatan:</strong>  
                        <ul class="mb-0 ps-3">
                            <li>Tera timbangan dilakukan di setiap awal produksi</li>
                            <li>Timbangan ditera menggunakan anak timbangan standar</li>
                            <li>Jika ada selisih angka timbang dengan berat timbangan standar, beri keterangan <strong>(+)</strong> atau <strong>(-)</strong> angka selisih</li>
                        </ul>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kode Timbangan</label>
                                <input type="text" id="kode_timbangan" name="kode_timbangan" 
                                       class="form-control" 
                                       value="{{ old('kode_timbangan', $timbangan->kode_timbangan) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Standar (gr)</label>
                                <input type="text" id="standar" name="standar" 
                                       class="form-control" 
                                       value="{{ old('standar', $timbangan->standar) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Pukul</label>
                                <input type="time" id="timeInput" name="waktu_tera" 
                                       class="form-control" 
                                       value="{{ old('waktu_tera', $timbangan->waktu_tera ? \Carbon\Carbon::parse($timbangan->waktu_tera)->format('H:i') : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hasil Tera</label>
                                <input type="text" id="hasil_tera" name="hasil_tera" 
                                       class="form-control" 
                                       value="{{ old('hasil_tera', $timbangan->hasil_tera) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Tindakan Perbaikan</label>
                                <textarea name="tindakan_perbaikan" class="form-control" rows="3" placeholder="Tulis tindakan perbaikan">{{ old('tindakan_perbaikan', $timbangan->tindakan_perbaikan) }}</textarea>
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
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $timbangan->catatan) }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('timbangan.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
