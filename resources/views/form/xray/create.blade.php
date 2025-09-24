@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-plus-circle"></i> Form Input Pemeriksaan X RAY</h4>
            <form method="POST" action="{{ route('xray.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Bagian Identitas --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" value="{{ old('date', $data->date ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift', $data->shift ?? '') == '1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $data->shift ?? '') == '2' ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $data->shift ?? '') == '3' ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <select id="nama_produk" name="nama_produk" class="form-control selectpicker" data-live-search="true" title="Ketik nama produk..." required>
                                @foreach($produks as $produk)
                                <option value="{{ $produk->nama_produk }}"
                                    {{ old('nama_produk', $data->nama_produk ?? '') == $produk->nama_produk ? 'selected' : '' }}>
                                    {{ $produk->nama_produk }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kode Produksi</label>
                            <input type="text" id="kode_produksi" name="kode_produksi" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">No. Program</label>
                            <input type="text" id="no_program" name="no_program" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Pemeriksaan X-Ray --}}
            <div class="card mb-4">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <strong>Pemeriksaan X-Ray</strong>
                    <button type="button" id="addpemeriksaanRow" class="btn btn-primary btn-sm">
                        + Tambah Baris
                    </button>
                </div>
                <div class="card-body table-responsive" style="overflow-x:auto;">
                    <div class="alert alert-danger mt-2 py-2 px-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Catatan:</strong>  
                        <i class="bi bi-check-circle text-success"></i> Checkbox apabila hasil <u>Oke</u>. Kosongkan Checkbox apabila hasil <u>Tidak Oke</u>.
                    </div>

                    <table class="table table-bordered table-sm text-center align-middle" id="pemeriksaanTable">
                        <thead class="table-light">
                            <tr>
                                <th>Pukul</th>
                                <th>Glass Ball</th>
                                <th>Status</th>
                                <th>Ceramic</th>
                                <th>Status</th>
                                <th>SUS 304 (wire)</th>
                                <th>Status</th>
                                <th>SUS 304 (ball)</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Tindakan Koreksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="pemeriksaan">
                            <tr>
                                <td><input type="time" name="pemeriksaan[0][pukul]" class="form-control form-control-sm"></td>
                                <td><input type="text" name="pemeriksaan[0][glass_ball]" class="form-control form-control-sm"></td>
                                <td><div class="form-check text-center m-0"><input type="checkbox" name="pemeriksaan[0][glass_ball_status]" class="form-check-input" value="Oke"></div></td>
                                <td><input type="text" name="pemeriksaan[0][ceramic]" class="form-control form-control-sm"></td>
                                <td><div class="form-check text-center m-0"><input type="checkbox" name="pemeriksaan[0][ceramic_status]" class="form-check-input" value="Oke"></div></td>
                                <td><input type="text" name="pemeriksaan[0][sus_wire]" class="form-control form-control-sm"></td>
                                <td><div class="form-check text-center m-0"><input type="checkbox" name="pemeriksaan[0][sus_wire_status]" class="form-check-input" value="Oke"></div></td>
                                <td><input type="text" name="pemeriksaan[0][sus_ball]" class="form-control form-control-sm"></td>
                                <td><div class="form-check text-center m-0"><input type="checkbox" name="pemeriksaan[0][sus_ball_status]" class="form-check-input" value="Oke"></div></td>
                                <td>
                                    <select name="pemeriksaan[0][keterangan]" class="form-control form-control-sm" required>
                                        <option value="Terdeteksi" {{ old('pemeriksaan.0.keterangan', $pemeriksaanData[0]['keterangan'] ?? '') == 'Terdeteksi' ? 'selected' : '' }}>Terdeteksi</option>
                                        <option value="Tidak Terdeteksi" {{ old('pemeriksaan.0.keterangan', $pemeriksaanData[0]['keterangan'] ?? '') == 'Tidak Terdeteksi' ? 'selected' : '' }}>Tidak Terdeteksi</option>
                                    </select>
                                </td>

                                <td><input type="text" name="pemeriksaan[0][tindakan_koreksi]" class="form-control form-control-sm"></td>
                                <td><button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Catatan --}}
            <div class="card mb-4">
                <div class="card-header bg-light"><strong>Catatan</strong></div>
                <div class="card-body">
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $data->catatan ?? '') }}</textarea>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-success w-auto"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('xray.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Pastikan jQuery di-load terlebih dahulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap-Select CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        // Inisialisasi selectpicker setelah DOM siap
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");
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
    document.addEventListener("DOMContentLoaded", function () {
        const table = document.getElementById('pemeriksaanTable');
        const addBtn = document.getElementById('addpemeriksaanRow');

        addBtn.addEventListener('click', function () {
            const lastTbody = table.querySelector('tbody:last-of-type');
            const clone = lastTbody.cloneNode(true);

        // hitung index baru
            let index = table.querySelectorAll('tbody').length;

        // update semua input name + kosongkan value
            clone.querySelectorAll('input').forEach(function(el) {
                if(el.name) el.name = el.name.replace(/\[\d+\]/, '['+index+']');
                if(el.type === 'checkbox') el.checked = false;
                else el.value = '';
            });

        // tombol hapus
            clone.querySelector('.removeRow').addEventListener('click', function() {
                clone.remove();
            });

            table.appendChild(clone);
        });

    // hapus baris pertama pun bisa jika mau
        table.querySelectorAll('.removeRow').forEach(btn => {
            btn.addEventListener('click', function() {
                btn.closest('tr').remove();
            });
        });
    });
</script>

<style>
    .form-control-sm { min-width: 120px; }
    .form-check-input { width: 20px; height: 20px; margin: 0 auto; }
    .form-check { display: flex; justify-content: center; align-items: center; height: 100%; }
    .table-bordered th, .table-bordered td { text-align: center; vertical-align: middle; }
</style>
@endsection
