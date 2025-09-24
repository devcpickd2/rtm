@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Pemeriksaan Proses Thumbling</h4>
            <form method="POST" action="{{ route('thumbling.update', $thumbling->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Bagian Identitas --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control"
                                value="{{ old('date', $thumbling->date ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift', $thumbling->shift) == '1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $thumbling->shift) == '2' ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $thumbling->shift) == '3' ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <select id="nama_produk" name="nama_produk" class="form-control selectpicker" data-live-search="true" required>
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->nama_produk }}"
                                        {{ old('nama_produk', $thumbling->nama_produk) == $produk->nama_produk ? 'selected' : '' }}>
                                        {{ $produk->nama_produk }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian Pemeriksaan Thumbling --}}
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                        <strong>Proses Thumbling</strong>
                        <button type="button" id="addthumblingColumn" class="btn btn-primary btn-sm">+ Tambah Batch</button>
                    </div>
                    <div class="card-body table-responsive" style="overflow-x:auto;">
                        <div class="alert alert-danger mt-2 py-2 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Keterangan:</strong>
                            Data yang sudah tersimpan tidak dapat dihapus kembali.
                        </div>
                        <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Kondisi daging:</strong>
                            Aroma segar, tidak busuk, bebas dari kontaminasi benda asing.
                        </div>
                        <table class="table table-bordered table-sm text-center align-middle" id="thumblingTable">
                            <thead class="table-light">
                                <tr id="headerRow">
                                    <th style="min-width: 220px; text-align: left;">Parameter</th>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <th colspan="3" class="batch-header batch-{{ $index}}">Batch No. {{ $index }}</th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                {{-- BATCH NO. --}}
                                <tr>
                                    <td class="text-left"><strong>BATCH NO.</strong></td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3">
                                        <input type="text" name="thumbls[{{ $index }}][batch]" class="form-control form-control-sm"
                                        value="{{ old("thumbls.{$index}.batch", $batch['batch'] ?? '') }}">
                                    </td>
                                    @endforeach
                                </tr>

                                {{-- IDENTIFIKASI DAGING --}}
                                <tr>
                                    <td class="text-left"><strong>IDENTIFIKASI DAGING</strong></td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3">
                                        <input type="text" name="thumbls[{{ $index }}][daging]" class="form-control form-control-sm"
                                        value="{{ old("thumbls.{$index}.daging", $batch['daging'] ?? '') }}">
                                    </td>
                                    @endforeach
                                </tr>

                                {{-- Asal --}}
                                <tr>
                                    <td class="text-left">Asal</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3">
                                        <input type="text" name="thumbls[{{ $index }}][asal]" class="form-control form-control-sm"
                                        value="{{ old("thumbls.{$index}.asal", $batch['asal'] ?? '') }}">
                                    </td>
                                    @endforeach
                                </tr>

                                @php
                                $kode_daging_data = $batch['kode_daging'] ?? [];
                                @endphp
                                <tr>
                                    <td class="text-left">Tanggal Produksi / Kode</td>
                                    @foreach($thumbling->thumbls as $batchIndex => $batch)
                                    @php $kode_daging_data = $batch['kode_daging'] ?? []; @endphp
                                    @for($i=0; $i<3; $i++)
                                    <td>
                                        @for($s=0; $s<2; $s++)
                                        @php $index = $i*2 + $s; $kd = $kode_daging_data[$index] ?? []; @endphp
                                        <input type="text" name="thumbls[{{ $batchIndex }}][kode_daging][{{ $index }}][kode]"
                                        class="form-control form-control-sm"
                                        value="{{ old("thumbls.$batchIndex.kode_daging.$index.kode", $kd['kode'] ?? '') }}">
                                        @endfor
                                    </td>
                                    @endfor
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="text-left">Berat (kg)</td>
                                    @foreach($thumbling->thumbls as $batchIndex => $batch)
                                    @php $kode_daging_data = $batch['kode_daging'] ?? []; @endphp
                                    @for($i=0; $i<3; $i++)
                                    <td>
                                        @for($s=0; $s<2; $s++)
                                        @php $index = $i*2 + $s; $kd = $kode_daging_data[$index] ?? []; @endphp
                                        <input type="number" step="0.01" name="thumbls[{{ $batchIndex }}][kode_daging][{{ $index }}][berat]"
                                        class="form-control form-control-sm"
                                        value="{{ old("thumbls.$batchIndex.kode_daging.$index.berat", $kd['berat'] ?? '') }}">
                                        @endfor
                                    </td>
                                    @endfor
                                    @endforeach
                                </tr>


                                <tr class="row-kode-suhu">
                                    <td class="text-left">Suhu Daging (0 - 10°C)</td>
                                    @foreach($thumbling->thumbls as $batchIndex => $batch)
                                    @php $kode_daging_data = $batch['kode_daging'] ?? []; @endphp
                                    @for($i=0; $i<3; $i++)
                                    <td>
                                        @for($s=0; $s<4; $s++)
                                        <input type="number" step="0.1" name="thumbls[{{ $batchIndex }}][kode_daging][{{ $i }}][suhu_daging][]"
                                        class="form-control form-control-sm mb-1 suhu-daging"
                                        value="{{ old("thumbls.$batchIndex.kode_daging.$i.suhu_daging.$s", $kode_daging_data[$i]['suhu_daging'][$s] ?? '') }}">
                                        @endfor
                                    </td>
                                    @endfor
                                    @endforeach
                                </tr>

                                <tr class="rata-row">
                                    <td class="text-left">Rata-rata</td>
                                    @foreach($thumbling->thumbls as $batchIndex => $batch)
                                    @php $kd = $batch['kode_daging'] ?? []; @endphp
                                    @for($i=0; $i<3; $i++)
                                    <td>
                                        <input type="number" step="0.01" name="thumbls[{{ $batchIndex }}][kode_daging][{{ $i }}][rata_rata_suhu]"
                                        class="form-control form-control-sm rata-rata"
                                        value="{{ old("thumbls.$batchIndex.kode_daging.$i.rata_rata_suhu", $kd[$i]['rata_rata_suhu'] ?? '') }}">
                                    </td>
                                    @endfor
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="text-left">Kondisi Daging</td>
                                    @foreach($thumbling->thumbls as $batchIndex => $batch)
                                    @php $kd = $batch['kode_daging'] ?? []; @endphp
                                    @for($i=0; $i<3; $i++)
                                    <td>
                                        <input type="text" name="thumbls[{{ $batchIndex }}][kode_daging][{{ $i }}][kondisi_daging]"
                                        class="form-control form-control-sm"
                                        value="{{ old("thumbls.$batchIndex.kode_daging.$i.kondisi_daging", $kd[$i]['kondisi_daging'] ?? '') }}">
                                    </td>
                                    @endfor
                                    @endforeach
                                </tr>
                                {{-- Marinade / Bahan Utama --}}
                                <tr>
                                    <td class="text-left"><strong>MARINADE</strong></td>
                                    <td colspan="{{ count($thumbling->thumbls) * 3 }}"></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Bahan Utama</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    @foreach($batch['bahan_utama'] ?? [] as $i => $bahan)
                                    <td>
                                        <input type="text" name="thumbls[{{ $index }}][bahan_utama][{{ $i }}][bahan]" class="form-control form-control-sm"
                                        value="{{ old("thumbls.{$index}.bahan_utama.{$i}.bahan", $bahan['bahan'] ?? '') }}">
                                    </td>
                                    @endforeach
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="text-left">Kode</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    @foreach($batch['bahan_utama'] ?? [] as $i => $bahan)
                                    <td>
                                        <input type="text" name="thumbls[{{ $index }}][bahan_utama][{{ $i }}][kode]" class="form-control form-control-sm"
                                        value="{{ old("thumbls.{$index}.bahan_utama.{$i}.kode", $bahan['kode'] ?? '') }}">
                                    </td>
                                    @endforeach
                                    @endforeach
                                </tr>

                                <tr>
                                    <td class="text-left">Berat (kg)</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    @foreach($batch['bahan_utama'] ?? [] as $i => $bahan)
                                    <td>
                                        <input type="number" step="0.01" name="thumbls[{{ $index }}][bahan_utama][{{ $i }}][berat]" class="form-control form-control-sm"
                                        value="{{ old("thumbls.{$index}.bahan_utama.{$i}.berat", $bahan['berat'] ?? '') }}">
                                    </td>
                                    @endforeach
                                    @endforeach
                                </tr>

                                {{-- Bahan Lain --}}
                                <tr class="bahan-lain-header">
                                    <th class="text-left">Bahan lain yang ditambahkan</th>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3" class="batch-{{ $index}}">
                                        <div class="d-flex justify-content-around fw-bold">
                                            <span>Kode</span>
                                            <span>Berat (kg)</span>
                                            <span>Sensori</span>
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>
                                @for($i=0; $i<6; $i++)
                                <tr>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    @php
                                    $bahan = $batch['bahan_lain'][$i] ?? [];
                                    @endphp

                                    {{-- Premix hanya untuk batch pertama --}}
                                    @if($index == 1)
                                    <td>
                                        <input type="text" name="thumbls[{{ $index }}][bahan_lain][{{ $i }}][premix]" class="form-control form-control-sm" value="{{ $bahan['premix'] ?? '' }}">
                                    </td>
                                    @endif

                                    {{-- Kolom lain tetap ada untuk semua batch --}}
                                    <td>
                                        <input type="text" name="thumbls[{{ $index }}][bahan_lain][{{ $i }}][kode]" class="form-control form-control-sm" value="{{ $bahan['kode'] ?? '' }}">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" name="thumbls[{{ $index }}][bahan_lain][{{ $i }}][berat]" class="form-control form-control-sm" value="{{ $bahan['berat'] ?? '' }}">
                                    </td>
                                    <td>
                                        <input type="hidden" name="thumbls[{{ $index }}][bahan_lain][{{ $i }}][sens]" value="tidak_sesuai">
                                        <input type="checkbox" name="thumbls[{{ $index }}][bahan_lain][{{ $i }}][sens]" value="sesuai" class="form-check-input big-checkbox" {{ ($bahan['sens'] ?? '') === 'sesuai' ? 'checked' : '' }}>
                                    </td>
                                    @endforeach
                                </tr>
                                @endfor

                                @foreach(['air','suhu_air','suhu_marinade', 'lama_pengadukan','brix'] as $param)
                                <tr>
                                    <td class="text-left">{{ ucwords(str_replace('_',' ', $param)) }}</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3">
                                        <input type="number" step="0.01" name="thumbls[{{ $index }}][{{ $param }}]" class="form-control form-control-sm" value="{{ $batch[$param] ?? '' }}">
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach

                                <tr>
                                    <td class="text-left"><strong>PARAMETER THUMBLING</strong></td>
                                    <td colspan="{{ count($thumbling->thumbls) * 3 }}"></td>
                                </tr>
                                @foreach(['drum_on','drum_off','drum_speed','vacuum_time','total_time'] as $param)
                                <tr>
                                    <td class="text-left">{{ ucwords(str_replace('_',' ', $param)) }}</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3">
                                        <input type="{{ in_array($param,['drum_on','drum_off','drum_speed']) ? 'number':'text'}}" step="0.01" name="thumbls[{{ $index }}][{{ $param }}]" class="form-control form-control-sm" value="{{ $batch[$param] ?? '' }}">
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach

                                {{-- Mulai - Selesai --}}
                                <tr>
                                    <td class="text-left">Mulai - Selesai</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td><input type="time" name="thumbls[{{ $index }}][mulai]" class="form-control form-control-sm" value="{{ $batch['mulai'] ?? '' }}"></td>
                                    <td>-</td>
                                    <td><input type="time" name="thumbls[{{ $index }}][selesai]" class="form-control form-control-sm" value="{{ $batch['selesai'] ?? '' }}"></td>
                                    @endforeach
                                </tr>

                                {{-- Hasil Tumbling --}}
                                <tr>
                                    <td class="text-left"><strong>HASIL THUMBLING</strong></td>
                                    <td colspan="{{ count($thumbling->thumbls) * 3 }}"></td>
                                </tr>
                                <tr class="row-hasil-suhu">
                                    <td class="text-left">Suhu Daging (°C)</td>
                                    @foreach($thumbling->thumbls as $batchIndex => $batch)
                                    @for($i=0; $i<3; $i++) {{-- kolom per batch --}}
                                    <td>
                                        @for($s=0; $s<4; $s++) {{-- 4 input suhu --}}
                                        @php
                                        $value = $batch['hasil_tumbling'][$i]['suhu_daging'][$s] ?? '';
                                        @endphp
                                        <input type="number" step="0.1"
                                        name="thumbls[{{ $batchIndex }}][hasil_tumbling][{{ $i }}][suhu_daging][]"
                                        class="form-control form-control-sm mb-1 suhu-hasil"
                                        value="{{ old("thumbls.$batchIndex.hasil_tumbling.$i.suhu_daging.$s", $value) }}">
                                        @endfor
                                    </td>
                                    @endfor
                                    @endforeach
                                </tr>


                                <tr class="hasil-rata-row">
                                    <td class="text-left">Rata-rata</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3">
                                        <input type="number" step="0.01" name="thumbls[{{ $index }}][hasil_tumbling][rata_rata]" class="form-control form-control-sm rata-rata-hasil" value="{{ $batch['hasil_tumbling']['rata_rata'] ?? '' }}">
                                    </td>
                                    @endforeach
                                </tr>

                                {{-- Kondisi & Catatan --}}
                                <tr>
                                    <td class="text-left"><strong>Kondisi</strong></td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3"><input type="text" name="thumbls[{{ $index }}][kondisi]" class="form-control form-control-sm" value="{{ $batch['kondisi'] ?? '' }}"></td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="text-left"><strong>Catatan</strong></td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3"><textarea name="thumbls[{{ $index }}][catatan]" class="form-control form-control-sm">{{ $batch['catatan'] ?? '' }}</textarea></td>
                                    @endforeach
                                </tr>

                                {{-- Section Aksi --}}
                                <tr class="aksi-row">
                                    <td class="text-left">Aksi</td>
                                    @foreach($thumbling->thumbls as $index => $batch)
                                    <td colspan="3" class="batch-{{ $index }}">
                                        {{-- Tidak ada tombol hapus untuk batch lama --}}
                                    </td>
                                    @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $thumbling->catatan ?? '') }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto"><i class="bi bi-save"></i> Update</button>
                    <a href="{{ route('thumbling.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- libs --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>

<style>
    #thumblingTable th {
        background-color: #f8f9fa;
        font-weight: bold;
        text-align: center;
    }
    #thumblingTable td {
        padding: 10px;
        vertical-align: middle;
        text-align: center;
    }
    #thumblingTable tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }
    #thumblingTable tbody tr:hover {
        background-color: #e9f7fe;
    }
    .form-control-sm { min-width: 120px; 
    }
    .big-checkbox {
        width: 22px;
        height: 22px;
    }
</style>
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
/* Utility: replace first numeric bracket in a name (outer batch index) */
    function replaceBatchIndexInName(name, newIndex) {
        if (!name) return name;
    // Replace first numeric bracket [N] with new index
        return name.replace(/\[\d+\]/, `[${newIndex}]`);
    }

    function clearInputsInElement(el) {
        el.querySelectorAll('input, textarea, select').forEach(inp => {
            if (inp.tagName.toLowerCase() === 'input') {
                let type = inp.type;
                if (type === 'text' || type === 'number' || type === 'date' || type === 'time' || type === 'hidden') {
                    inp.value = '';
                } else if (type === 'checkbox' || type === 'radio') {
                    inp.checked = false;
                } else if (type === 'file') {
                // cannot programmatically set file input for security; replace by clone
                    try {
                        let clone = inp.cloneNode();
                        inp.parentNode.replaceChild(clone, inp);
                } catch (err) { /* ignore */ }
                    } else {
                        inp.value = '';
                    }
                } else if (inp.tagName.toLowerCase() === 'textarea') {
                    inp.value = '';
                } else if (inp.tagName.toLowerCase() === 'select') {
                    inp.selectedIndex = 0;
                }
            });
    }

/* Update 'name' attributes inside an element to use new batch index */
    function updateNamesInElement(el, newBatchIndex) {
        el.querySelectorAll('input, textarea, select').forEach(inp => {
            let oldName = inp.getAttribute('name');
            if (oldName) {
                let newName = replaceBatchIndexInName(oldName, newBatchIndex);
                inp.setAttribute('name', newName);
            }
        });
    }

/* Compute average for inputs inside the same TD and write to corresponding rata TD */
    function computeAverageForTdAndWrite(td, rataRow) {
        let inputs = Array.from(td.querySelectorAll('input')).filter(i => i.type === 'number' || i.type === 'text' || i.hasAttribute('step'));
    // consider only numeric values
        let vals = inputs.map(i => parseFloat(i.value)).filter(v => !isNaN(v));
        let avg = vals.length ? (vals.reduce((a,b)=>a+b,0)/vals.length) : null;

        if (!rataRow) return;
    // find column index of this td within its row
        let colIndex = Array.prototype.indexOf.call(td.parentElement.children, td);
        let rataCells = rataRow.children;
        if (colIndex >= 0 && colIndex < rataCells.length) {
            let targetTd = rataCells[colIndex];
            if (!targetTd) return;
            let input = targetTd.querySelector('input');
            if (input) {
                input.value = (avg !== null) ? avg.toFixed(2) : '';
            } else {
            // if rata cell is colspan (e.g. hasil rata), set value if it contains input
            // handled above
            }
        }
    }

/* Event listeners for suhu-daging (per-column avg) */
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('suhu-daging')) {
            let td = e.target.closest('td');
        // rata row for kode_daging is .rata-row
            let rataRow = document.querySelector('#thumblingTable tbody .rata-row');
            computeAverageForTdAndWrite(td, rataRow);
        }

        if (e.target.classList.contains('suhu-hasil')) {
            let td = e.target.closest('td');
        // hasil rata row is .hasil-rata-row
            let hasilRataRow = document.querySelector('#thumblingTable tbody .hasil-rata-row');
        // Note: hasil-rata-row may have single td with colspan for all batches; handle mapping by column index:
            if (hasilRataRow) {
            // If hasil-rata-row has only one td (colspan), try to put average into the same td's input (common in original)
                if (hasilRataRow.children.length === 1) {
                    let inputs = td.querySelectorAll('input');
                    let vals = Array.from(inputs).map(i=>parseFloat(i.value)).filter(v=>!isNaN(v));
                    let avg = vals.length ? (vals.reduce((a,b)=>a+b,0)/vals.length) : null;
                    let target = hasilRataRow.children[0].querySelector('input');
                    if (target) target.value = avg !== null ? avg.toFixed(2) : '';
                } else {
                    computeAverageForTdAndWrite(td, hasilRataRow);
                }
            }
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const table = document.getElementById("thumblingTable");
        const headerRow = document.getElementById("headerRow");
        const addBtn = document.getElementById("addthumblingColumn");

    // ensure aksi-row exists
        let aksiRow = table.querySelector(".aksi-row");
        if (!aksiRow) {
            let tbody = table.tBodies[0];
            aksiRow = document.createElement("tr");
            aksiRow.classList.add("aksi-row");
            aksiRow.innerHTML = `<td class="text-left">Aksi</td><td colspan="3" id="aksiCell"></td>`;
            tbody.appendChild(aksiRow);
        }

        addBtn.addEventListener("click", function () {
        // current batch count based on header batch elements
            let batchCount = headerRow.querySelectorAll("th.batch-header").length;
            let newBatchIndex = batchCount + 1;

        // 1) Tambah header
            let newTh = document.createElement("th");
            newTh.colSpan = 3;
            newTh.innerText = "Batch No. " + newBatchIndex;
            newTh.classList.add("batch-header", "batch-" + newBatchIndex);
            headerRow.appendChild(newTh);

        // 2) Untuk setiap row di tbody, tambahkan sel yang sesuai (clone dari last batch area)
            let tbody = table.tBodies[0];
            let rows = Array.from(tbody.rows);

            rows.forEach(row => {
            if (row.classList.contains('aksi-row')) return; // skip aksi row here

            // find TD cells only (skip TH if any)
            let cells = Array.from(row.children).filter(c => c.tagName.toLowerCase() === 'td');
            if (cells.length === 0) return;

            let lastCell = cells[cells.length - 1];

            // special case: bahan-lain-header row -> add a colspan=3 cell with same inner structure
            if (row.classList.contains('bahan-lain-header')) {
                let newTd = document.createElement("td");
                newTd.colSpan = 3;
                newTd.classList.add("batch-" + newBatchIndex);
                newTd.innerHTML = `
                    <div class="d-flex justify-content-around fw-bold">
                        <span>Kode</span>
                        <span>Berat (kg)</span>
                        <span>Sensori</span>
                    </div>
                `;
                row.appendChild(newTd);
                return;
            }

            // If last cell is a colspan cell (colSpan > 1), clone only that cell
            if (lastCell.colSpan && lastCell.colSpan > 1) {
                let clone = lastCell.cloneNode(true);
                // update names inside clone and clear values
                updateNamesInElement(clone, newBatchIndex);
                clearInputsInElement(clone);
                clone.classList.add("batch-" + newBatchIndex);
                row.appendChild(clone);
            } else {
                // otherwise clone last 3 cells (one batch = 3 columns)
                let cellsPerBatch = 3;
                let lastBatchCells = cells.slice(-cellsPerBatch);
                lastBatchCells.forEach(origCell => {
                    let clone = origCell.cloneNode(true);
                    updateNamesInElement(clone, newBatchIndex);
                    clearInputsInElement(clone);
                    clone.classList.add("batch-" + newBatchIndex);
                    row.appendChild(clone);
                });
            }
        });

        // 3) Tambah tombol hapus batch di baris aksi
            let aksi = tbody.querySelector(".aksi-row");
            if (aksi) {
                let removeTd = document.createElement("td");
                removeTd.setAttribute("colspan", 3);
                removeTd.classList.add("batch-" + newBatchIndex);
                removeTd.innerHTML = `<button type="button" class="btn btn-danger btn-sm removeColumn" data-batch="${newBatchIndex}">Hapus Batch ${newBatchIndex}</button>`;
                aksi.appendChild(removeTd);
            }
        });

    // Hapus batch (delegated)
        document.addEventListener("click", function (e) {
            if (e.target.classList.contains("removeColumn")) {
                let batchId = e.target.dataset.batch;
                if (!batchId) return;

            // hapus header
                let header = headerRow.querySelector(".batch-" + batchId);
                if (header) header.remove();

            // hapus sel di setiap baris
                Array.from(table.tBodies[0].rows).forEach(row => {
                // remove any td with class batch-X
                    row.querySelectorAll(".batch-" + batchId).forEach(td => td.remove());
                });

            // hapus tombol remove sendiri (kolom di aksi row)
            // already removed by above

            // re-label header Batch No. text (optional: keep continuous numbering)
            // We'll re-number headers to remain sequential (1..n)
                let headers = headerRow.querySelectorAll("th.batch-header");
                headers.forEach((th, idx) => {
                    let newIdx = idx + 1;
                    th.className = `batch-header batch-${newIdx}`;
                    th.innerText = `Batch No. ${newIdx}`;
                });

            // Re-number td classes and names so outer batch indices are contiguous again
            // (optional but helps keep thumbling structure neat)
            // We'll update all name attributes: replace first [\d+] with new index based on their column position.
            // Simpler approach: rebuild batch index mapping from headers
                let currentBatchCount = headerRow.querySelectorAll("th.batch-header").length;
            // if no batch left, do nothing
                if (currentBatchCount <= 0) return;

            // walk rows and for each batch column group, set correct [batchIndex] in names
                Array.from(table.tBodies[0].rows).forEach(row => {
                    if (row.classList.contains('aksi-row')) return;
                // get all tds excluding the first parameter td
                    let tds = Array.from(row.children).filter((c)=> c.tagName.toLowerCase() === 'td');
                // number of batches = headers length
                    let expectedBatches = headerRow.querySelectorAll('th.batch-header').length;
                // index starts at 1 for batch 1 -> tds for each batch occupy either colspan=3 or single td repeated
                // We'll reassign by scanning from right-to-left: map existing batch-classes order to new indices
                // Build list of batch group tds by grouping consecutive tds from the end into groups of size 3 or single colspan cells
                // Simpler: For each td that has class 'batch-N' update name attributes by replacing first [\d+] with its new index
                // We map old class number to new sequential number by scanning headerRow order:
                    let headerMap = {};
                    Array.from(headerRow.querySelectorAll('th.batch-header')).forEach((th, idx) => {
                    // old classes like batch-2, batch-3 may not be contiguous; but th may contain that old class
                    // try to find old number inside classList
                        let found = Array.from(th.classList).find(c => c.startsWith('batch-') && c !== 'batch-header');
                        if (found) {
                            let oldNum = found.split('-')[1];
                        headerMap[oldNum] = idx + 1; // new index
                    }
                });

                // now for each td that has class batch-X, update names inside to new batch index headerMap[X]
                    row.querySelectorAll('td').forEach(td => {
                        td.classList.forEach(cls => {
                            if (cls.startsWith('batch-')) {
                                let oldN = cls.split('-')[1];
                                let newN = headerMap[oldN];
                                if (newN) {
                                // update names inside this td
                                    updateNamesInElement(td, newN);
                                // update the class to new one
                                    td.classList.remove(`batch-${oldN}`);
                                    td.classList.add(`batch-${newN}`);
                                }
                            }
                        });
                    });
                });

            // also update aksi-row remove buttons thumbling-batch attributes and label
                let aksi = table.querySelector('.aksi-row');
                if (aksi) {
                    let removes = aksi.querySelectorAll('.removeColumn');
                    removes.forEach(btn => {
                    // find current class batch-X on parent td
                        let td = btn.closest('td');
                        if (!td) return;
                    // get class like batch-?
                        let cls = Array.from(td.classList).find(c => c.startsWith('batch-'));
                        if (!cls) return;
                        let oldNum = cls.split('-')[1];
                        let newNum = headerMap[oldNum];
                        if (newNum) {
                            btn.thumblingset.batch = newNum;
                            btn.innerText = `Hapus Batch ${newNum}`;
                        // update td class already handled above
                        }
                    });
                }
            }
        });
});
</script>

@endsection
