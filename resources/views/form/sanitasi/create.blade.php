@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-plus-circle"></i> Form Input Pemeriksaan Sanitasi</h4>
            <form method="POST" action="{{ route('sanitasi.store') }}" enctype="multipart/form-data">
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

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Pemeriksaan Area</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Standar Foot Basin (200 ppm)</label>
                                <input type="number" id="std_footbasin" name="std_footbasin" class="form-control" value="200">
                                <div id="footbasin-warning" class="text-danger mt-1" style="display:none;">Melebihi batas 200 ppm!</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Aktual Foot Basin (Upload Gambar)</label>
                                <input type="file" id="aktual_footbasin" name="aktual_footbasin" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Standar Hand Basin (50 ppm)</label>
                                <input type="number" id="std_handbasin" name="std_handbasin" class="form-control"  value="50">
                                <div id="handbasin-warning" class="text-danger mt-1" style="display:none;">Melebihi batas 50 ppm!</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Aktual Hand Basin (Upload Gambar)</label>
                                <input type="file" id="aktual_handbasin" name="aktual_handbasin" class="form-control" accept="image/*">
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
                        <strong>Tindakan Koreksi</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="tindakan_koreksi" class="form-control" rows="3" placeholder="Tambahkan tindakan koreksi bila ada"></textarea>
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
                    <a href="{{ route('sanitasi.index') }}" class="btn btn-secondary w-auto">
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

    });
</script>
<script>
    const footInput = document.getElementById('std_footbasin');
    const footWarning = document.getElementById('footbasin-warning');
    const handInput = document.getElementById('std_handbasin');
    const handWarning = document.getElementById('handbasin-warning');

    footInput.addEventListener('input', function() {
        if (parseFloat(footInput.value) !== 200) {
            footWarning.style.display = 'block';
            footWarning.textContent = 'Nilai harus 200 ppm!';
        } else {
            footWarning.style.display = 'none';
        }
    });

    handInput.addEventListener('input', function() {
        if (parseFloat(handInput.value) !== 50) {
            handWarning.style.display = 'block';
            handWarning.textContent = 'Nilai harus 50 ppm!';
        } else {
            handWarning.style.display = 'none';
        }
    });

</script>
@endsection
