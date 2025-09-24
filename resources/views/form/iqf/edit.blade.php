@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Form Edit Pengecekan Suhu Produk Setiap IQF Proses</h4>
            <form method="POST" action="{{ route('iqf.update', $iqf->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Bagian Identitas --}}
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" 
                                value="{{ old('date', $iqf->date) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift',$iqf->shift)=='1'?'selected':'' }}>Shift 1</option>
                                    <option value="2" {{ old('shift',$iqf->shift)=='2'?'selected':'' }}>Shift 2</option>
                                    <option value="3" {{ old('shift',$iqf->shift)=='3'?'selected':'' }}>Shift 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">IQF No.</label>
                                <input type="text" id="no_iqf" name="no_iqf" class="form-control" 
                                value="{{ old('no_iqf',$iqf->no_iqf) }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Nama Produk</label>
                                <select id="nama_produk" name="nama_produk" class="form-control selectpicker" 
                                data-live-search="true" title="Ketik nama produk..." required>
                                @foreach($produks as $produk)
                                <option value="{{ $produk->nama_produk }}" 
                                    {{ old('nama_produk',$iqf->nama_produk)==$produk->nama_produk?'selected':'' }}>
                                    {{ $produk->nama_produk }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kode Produksi</label>
                            <input type="text" id="kode_produksi" name="kode_produksi" class="form-control" 
                            value="{{ old('kode_produksi',$iqf->kode_produksi) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Std CT (°C)</label>
                            <select id="std_suhu" name="std_suhu" class="form-control" required>
                                <option value="-18.0" {{ old('std_suhu',$iqf->std_suhu)=='-18.0'?'selected':'' }}>-18.0</option>
                                <option value="-10.0" {{ old('std_suhu',$iqf->std_suhu)=='-10.0'?'selected':'' }}>-10.0</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Pemeriksaan --}}
            <div class="card mb-3">
                <div class="card-header bg-info text-white text-center">
                    <strong>Suhu Pusat Produk (°C)</strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0 text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Pukul</th>
                                <th></th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>X</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td rowspan="2">
                                <input type="time" name="pukul" class="form-control form-control-sm"
                                value="{{ old('pukul',$iqf->pukul) }}">
                            </td>
                            <td>Suhu</td>
                            @for($i=1;$i<=10;$i++)
                            <td>
                                <input type="number" name="suhu_pusat[{{ $i }}][value]" step="0.1"
                                class="form-control form-control-sm"
                                value="{{ old("suhu_pusat.$i.value", $iqf->suhu_pusat[$i]['value'] ?? '') }}">
                            </td>
                            @endfor
                            <td rowspan="2">
                                <input type="number" name="average" class="form-control form-control-sm" step="0.01"
                                value="{{ old('average',$iqf->average) }}">
                            </td>
                        </tr>
                    </tbody>

                    <tbody>
                      <tr>
                        <td></td>
                        <td>Keterangan</td>
                        @for($i=1;$i<=10;$i++)
                        <td>
                            <input type="text" name="suhu_pusat[{{ $i }}][ket]"
                            class="form-control form-control-sm"
                            value="{{ old("suhu_pusat.$i.ket", $iqf->suhu_pusat[$i]['ket'] ?? '') }}">
                        </td>
                        @endfor
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Notes --}}
    <div class="card mb-3">
        <div class="card-header bg-light"><strong>Problem</strong></div>
        <div class="card-body">
            <textarea name="problem" class="form-control" rows="3">{{ old('problem',$iqf->problem) }}</textarea>
        </div>
        <div class="card-header bg-light"><strong>Tindakan Koreksi</strong></div>
        <div class="card-body">
            <textarea name="tindakan_koreksi" class="form-control" rows="3">{{ old('tindakan_koreksi',$iqf->tindakan_koreksi) }}</textarea>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-light"><strong>Catatan</strong></div>
        <div class="card-body">
            <textarea name="catatan" class="form-control" rows="3">{{ old('catatan',$iqf->catatan) }}</textarea>
        </div>
    </div>

    {{-- Tombol --}}
    <div class="d-flex justify-content-between mt-3">
        <button class="btn btn-success w-auto">
            <i class="bi bi-save"></i> Update
        </button>
        <a href="{{ route('iqf.index') }}" class="btn btn-secondary w-auto">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</form>
</div>
</div>
</div>

<!-- jQuery dulu (wajib) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap-Select CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>
<style>
/* Supaya tabel lebih lebar */
.table {
  width: 100%;
  table-layout: auto; /* kolom auto */
}

.table th,
.table td {
  padding: 0.75rem 0.75rem; /* Lebih besar dari sebelumnya */
  vertical-align: middle;
  font-size: 0.9rem;
}

/* Kolom input kecil tapi fleksibel */
.table input.form-control-sm {
  width: 100%;
  min-width: 80px;
  font-size: 0.9rem;
}

/* Input group supaya nggak mepet */
.input-group-sm > .form-control,
.input-group-sm > .input-group-text {
  height: calc(2em + 0.5rem + 2px);
  font-size: 0.9rem;
}

/* Tabel kecil (nama bahan + suhu) supaya nyaman */
.table td table {
  width: 100%;
}

.table td table th,
.table td table td {
  padding: 0.5rem;
  font-size: 0.85rem;
}

/* Buat judul header lebih bold dan jelas */
.table thead th {
  background-color: #f8f9fa;
  font-weight: 600;
  text-align: center;
}
.table-sm th, .table-sm td {
  padding: 0.5rem;
  vertical-align: middle;
}
.input-group-sm>.form-control,
.input-group-sm>.input-group-text {
  height: calc(1.5em + 0.5rem + 2px);
  font-size: 0.875rem;
}
</style>

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
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = [];
        for (let i = 1; i <= 10; i++) {
            inputs[i] = document.querySelector(`input[name="suhu_pusat[${i}][value]"]`);
            inputs[i].addEventListener('input', calculateAverage);
        }

        const avgInput = document.querySelector('input[name="average"]');

        function calculateAverage() {
            let sum = 0;
            let count = 0;
            for (let i = 1; i <= 10; i++) {
                const val = parseFloat(inputs[i].value);
                if (!isNaN(val)) {
                    sum += val;
                    count++;
                }
            }
            avgInput.value = count > 0 ? (sum / count).toFixed(2) : '';
        }
    });
</script>

@endsection
