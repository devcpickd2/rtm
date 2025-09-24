@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-plus-circle"></i> Form Input Pemeriksaan Suhu Ruang</h4>
            <form method="POST" action="{{ route('suhu.store') }}">
                @csrf

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1">Shift 1</option>
                                    <option value="2">Shift 2</option>
                                    <option value="3">Shift 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pukul</label>
                                <input type="time" id="timeInput" name="pukul" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Suhu Ruangan --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <strong>Area Warehouse</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Chillroom (°C) <small class="text-muted">(0 - 4)</small></label>
                                <input type="number" step="0.1" name="chillroom" class="form-control suhu-check" data-min="0" data-max="4">
                                <small class="text-danger d-none">⚠ Suhu harus 0 - 4 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cold Storage 1 (°C) <small class="text-muted">(-20 ± 2)</small></label>
                                <input type="number" step="0.1" name="cs_1" class="form-control suhu-check" data-min="-22" data-max="-18">
                                <small class="text-danger d-none">⚠ Suhu harus -20 ± 2 °C</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Cold Storage 2 (°C) <small class="text-muted">(-20 ± 2)</small></label>
                                <input type="number" step="0.1" name="cs_2" class="form-control suhu-check" data-min="-22" data-max="-18">
                                <small class="text-danger d-none">⚠ Suhu harus -20 ± 2 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Anteroom RM (°C) <small class="text-muted">(8 - 10)</small></label>
                                <input type="number" step="0.1" name="anteroom_rm" class="form-control suhu-check" data-min="8" data-max="10">
                                <small class="text-danger d-none">⚠ Suhu harus 8 - 10 °C</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Seasoning --}}
                <div class="card mb-3">
                    <div class="card-header bg-warning">
                        <strong>Seasoning</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Suhu (°C) <small class="text-muted">(22 - 30)</small></label>
                                <input type="number" step="0.1" name="seasoning_suhu" class="form-control suhu-check" data-min="22" data-max="30">
                                <small class="text-danger d-none">⚠ Suhu harus 22 - 30 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">RH (%) <small class="text-muted">(&le; 75)</small></label>
                                <input type="number" step="0.1" name="seasoning_rh" class="form-control suhu-check" data-min="0" data-max="75">
                                <small class="text-danger d-none">⚠ RH max 75%</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Cooking --}}
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        <strong>Cooking</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Rice (°C) <small class="text-muted">(20 - 30)</small></label>
                                <input type="number" step="0.1" name="rice" class="form-control suhu-check" data-min="20" data-max="30">
                                <small class="text-danger d-none">⚠ Suhu harus 20 - 30 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Noodle (°C) <small class="text-muted">(20 - 30)</small></label>
                                <input type="number" step="0.1" name="noodle" class="form-control suhu-check" data-min="20" data-max="30">
                                <small class="text-danger d-none">⚠ Suhu harus 20 - 30 °C</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Prep. Room (°C) <small class="text-muted">(9 - 15)</small></label>
                                <input type="number" step="0.1" name="prep_room" class="form-control suhu-check" data-min="9" data-max="15">
                                <small class="text-danger d-none">⚠ Suhu harus 9 - 15 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cooking (°C) <small class="text-muted">(20 - 30)</small></label>
                                <input type="number" step="0.1" name="cooking" class="form-control suhu-check" data-min="20" data-max="30">
                                <small class="text-danger d-none">⚠ Suhu harus 20 - 30 °C</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Packing --}}
                <div class="card mb-3">
                    <div class="card-header bg-danger text-white">
                        <strong>Packing</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Filling Room (°C) <small class="text-muted">(9 - 15)</small></label>
                                <input type="number" step="0.1" name="filling" class="form-control suhu-check" data-min="9" data-max="15">
                                <small class="text-danger d-none">⚠ Suhu harus 9 - 15 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Topping (°C) <small class="text-muted">(9 - 15)</small></label>
                                <input type="number" step="0.1" name="topping" class="form-control suhu-check" data-min="9" data-max="15">
                                <small class="text-danger d-none">⚠ Suhu harus 9 - 15 °C</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Packing (°C) <small class="text-muted">(9 - 15)</small></label>
                                <input type="number" step="0.1" name="packing" class="form-control suhu-check" data-min="9" data-max="15">
                                <small class="text-danger d-none">⚠ Suhu harus 9 - 15 °C</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian DS --}}
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <strong>DS (Dry Storage)</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Suhu (°C) <small class="text-muted">(20 - 30)</small></label>
                                <input type="number" step="0.1" name="ds_suhu" class="form-control suhu-check" data-min="20" data-max="30">
                                <small class="text-danger d-none">⚠ Suhu harus 20 - 30 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">RH (%) <small class="text-muted">(&le; 75)</small></label>
                                <input type="number" step="0.1" name="ds_rh" class="form-control suhu-check" data-min="0" data-max="75">
                                <small class="text-danger d-none">⚠ RH max 75%</small>
                            </div> 
                        </div>
                    </div>
                </div>

                {{-- Bagian Finished Good --}}
                <div class="card mb-3">
                    <div class="card-header bg-dark text-white">
                        <strong>Finished Good</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Cold Stor. FG (°C) <small class="text-muted">(-19 ± 1)</small></label>
                                <input type="number" step="0.1" name="cs_fg" class="form-control suhu-check" data-min="-20" data-max="-18">
                                <small class="text-danger d-none">⚠ Suhu harus -19 ± 1 °C</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Anteroom FG (°C) <small class="text-muted">(0 - 10)</small></label>
                                <input type="number" step="0.1" name="anteroom_fg" class="form-control suhu-check" data-min="0" data-max="10">
                                <small class="text-danger d-none">⚠ Suhu harus 0 - 10 °C</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Keterangan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan bila ada"></textarea>
                    </div>
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada"></textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('suhu.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");
        const timeInput = document.getElementById("timeInput");
        const shiftInput = document.getElementById("shiftInput");

    // Ambil waktu sekarang
        let now = new Date();
        let yyyy = now.getFullYear();
        let mm = String(now.getMonth() + 1).padStart(2, '0');
        let dd = String(now.getDate()).padStart(2, '0');
        let hh = String(now.getHours()).padStart(2, '0');
        let min = String(now.getMinutes()).padStart(2, '0');

    // Set value tanggal dan jam
        dateInput.value = `${yyyy}-${mm}-${dd}`;
        timeInput.value = `${hh}:${min}`;

    // Tentukan shift berdasarkan jam
        let hour = parseInt(hh);
        if (hour >= 7 && hour < 15) {
            shiftInput.value = "1";
        } else if (hour >= 15 && hour < 23) {
            shiftInput.value = "2";
        } else {
            shiftInput.value = "3"; 
        }

    // Validasi suhu otomatis
        document.querySelectorAll(".suhu-check").forEach(function(input) {
            input.addEventListener("input", function () {
                let min = parseFloat(this.dataset.min);
                let max = parseFloat(this.dataset.max);
                let value = parseFloat(this.value);
                let warning = this.nextElementSibling;

                if (!isNaN(value) && (value < min || value > max)) {
                    this.classList.add("is-invalid");
                    warning.classList.remove("d-none");
                } else {
                    this.classList.remove("is-invalid");
                    warning.classList.add("d-none");
                }
            });
        });
    });
</script>
@endsection
