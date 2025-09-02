@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-plus-circle"></i> Form Input Parameter Produk Saus Yoshinoya</h4>
            <form method="POST" action="{{ route('yoshinoya.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Produksi</label>
                                <input type="date" id="dateInput" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1">Shift 1</option>
                                    <option value="2">Shift 2</option>
                                    <option value="3">Shift 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <strong>Parameter Pengecekan Saus Yoshinoya</strong>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                           <div class="col-md-6">
                            <label class="form-label">Jenis Saus</label>
                            <select id="saus" name="saus" class="form-control" required>
                                <option value="" disabled selected>Pilih Saus</option>
                                <option value="Yoshinoya">Yoshinoya</option>
                                <option value="Vegetable">Vegetable</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kode Produksi</label>
                            <input type="text" id="kode_produksi" name="kode_produksi" class="form-control" required>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Standar:</strong>  
                        <ul class="mb-0 ps-3">
                            <li>Suhu pengukuran: 24 - 26°C</li>
                        </ul>
                    </div>

                    {{-- Notes Vegetable --}}
                    <div class="alert alert-warning mt-2 py-2 px-3 note" id="note-vegetable-basic" style="font-size: 0.9rem; display:none;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Vegetable:</strong>  
                        <ul class="mb-0 ps-3">
                            <li>Brix: 6 - 12%</li>
                            <li>Salt: 6 - 12%</li>
                            <li>Viscositas: 20 - 50 detik.milidetik</li>
                        </ul>
                    </div>

                    {{-- Notes Yoshinoya --}}
                    <div class="alert alert-warning mt-2 py-2 px-3 note" id="note-yoshinoya-basic" style="font-size: 0.9rem; display:none;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Yoshinoya:</strong>  
                        <ul class="mb-0 ps-3">
                            <li>Brix: 33 - 38%</li>
                            <li>Salt: 14 - 17%</li>
                            <li>Viscositas: 70 - 130 detik.milidetik</li>
                        </ul>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Suhu Pengukuran (°C)</label>
                            <input type="text" id="suhu_pengukuran" name="suhu_pengukuran" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Brix (%)</label>
                            <input type="text" id="brix" name="brix" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Salt (%)</label>
                            <input type="text" id="salt" name="salt" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Viscositas (detik.milidetik)</label>
                            <input type="text" id="visco" name="visco" class="form-control" required>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-2 py-2 px-3 note" id="note-vegetable-brookfield" style="font-size: 0.9rem; display:none;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Vegetable:</strong>  
                        <ul class="mb-0 ps-3">
                            <li>Brookfield LV, S 64,. 30% RPM suhu saus 24 - 26°C: 1000 - 3000 Cp</li>
                            <li>Brookfield LV, S 64,. 30% RPM (Setelah Frozen) suhu saus 24 - 26°C: 1000 - 3000 Cp</li>
                        </ul>
                    </div>
                    <div class="alert alert-warning mt-2 py-2 px-3 note" id="note-yoshinoya-brookfield" style="font-size: 0.9rem; display:none;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Yoshinoya:</strong>  
                        <ul class="mb-0 ps-3">
                            <li>Brookfield LV, S 64,. 30% RPM suhu saus 24 - 26°C: 3000 - 5000 Cp</li>
                            <li>Brookfield LV, S 64,. 30% RPM (Setelah Frozen) suhu saus 24 - 26°C: 2500 - 3000 Cp</li>
                        </ul>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Brookfield LV, S 64,. 30% RPM suhu saus 24 - 26°C</label>
                            <input type="text" id="brookfield_sebelum" name="brookfield_sebelum" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Brookfield LV, S 64,. 30% RPM (Setelah Frozen) suhu saus 24 - 26°C</label>
                            <input type="text" id="brookfield_frozen" name="brookfield_frozen" class="form-control" required>
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
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada"></textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('yoshinoya.index') }}" class="btn btn-secondary w-auto">
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
    const sausSelect = document.getElementById('saus');
    const notes = document.querySelectorAll('.note');

    sausSelect.addEventListener('change', function() {
    // sembunyikan semua notes
        notes.forEach(note => note.style.display = 'none');

        if(this.value === 'Vegetable') {
            document.getElementById('note-vegetable-basic').style.display = 'block';
            document.getElementById('note-vegetable-brookfield').style.display = 'block';
        } else if(this.value === 'Yoshinoya') {
            document.getElementById('note-yoshinoya-basic').style.display = 'block';
            document.getElementById('note-yoshinoya-brookfield').style.display = 'block';
        }
    });

</script>
@endsection
