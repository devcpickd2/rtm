@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Edit Peneraan Thermometer</h4>
            <form method="POST" action="{{ route('thermometer.update', $thermometer->uuid) }}" enctype="multipart/form-data">
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
                                <input type="date" id="dateInput" name="date" class="form-control" value="{{ $thermometer->date }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ $thermometer->shift == 1 ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ $thermometer->shift == 2 ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ $thermometer->shift == 3 ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Peneraan Thermometer</strong>
                    </div>

                    {{-- Notes --}}
                    <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Catatan:</strong>  
                        <ul class="mb-0 ps-3">
                            <li>Tera termometer dilakukan di setiap awal produksi</li>
                            <li>Termometer ditera dengan memasukkan sensor di es (0 °C)</li>
                            <li>Jika ada selisih angka display suhu dengan suhu standar es, beri keterangan <strong>(+)</strong> atau <strong>(-)</strong> angka selisih (faktor koreksi)</li>
                            <li>Jika faktor koreksi &gt; 0,4 °C, thermometer perlu perbaikan</li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kode Thermometer</label>
                                <input type="text" id="kode_thermometer" name="kode_thermometer" class="form-control" value="{{ $thermometer->kode_thermometer }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Area</label>
                                <input type="text" id="area" name="area" class="form-control" value="{{ $thermometer->area }}" required>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Standar Tera:</strong>  
                            <ul class="mb-0 ps-3">
                                <li>0.0°C</li>
                            </ul>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                              <label class="form-label">Pukul</label>
                              <input type="time" id="timeInput" name="waktu_tera" class="form-control" value="{{ $thermometer->waktu_tera }}">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Hasil Tera</label>
                            <input type="number" step="0.01" id="hasil_tera" name="hasil_tera" class="form-control" value="{{ $thermometer->hasil_tera }}" required>
                            <small id="hasilWarning" class="text-danger fw-bold {{ abs($thermometer->hasil_tera) > 0.4 ? '' : 'd-none' }}">
                                ⚠️ Hasil melebihi standar!
                            </small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Tindakan Koreksi</label>
                            <textarea name="tindakan_koreksi" class="form-control" rows="3" placeholder="Tulis tindakan koreksi">{{ $thermometer->tindakan_koreksi }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ $thermometer->catatan }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('thermometer.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const hasilInput = document.getElementById("hasil_tera");
        const hasilWarning = document.getElementById("hasilWarning");

        hasilInput.addEventListener("input", function () {
            let value = parseFloat(hasilInput.value);
            if (!isNaN(value) && Math.abs(value) > 0.4) {
                hasilWarning.classList.remove("d-none");
            } else {
                hasilWarning.classList.add("d-none");
            }
        });
    });
</script>
@endsection
