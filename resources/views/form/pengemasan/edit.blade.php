@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body"> 
            <h4><i class="bi bi-pencil-square"></i> Form Edit Verifikasi Pengemasan</h4>
            <form method="POST" action="{{ route('pengemasan.update', $pengemasan->uuid) }}" enctype="multipart/form-data">
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
                                <label class="form-label">Nama Produk</label>
                                <select id="nama_produk" name="nama_produk" class="form-control selectpicker" data-live-search="true" title="Ketik nama produk..." required>
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->nama_produk }}" {{ $pengemasan->nama_produk == $produk->nama_produk ? 'selected' : '' }}>
                                        {{ $produk->nama_produk }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kode Produksi</label>
                                <input type="text" id="kode_produksi" name="kode_produksi" class="form-control" value="{{ $pengemasan->kode_produksi }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Catatan --}}
                <div class="alert alert-warning mt-2 py-2 px-3" style="font-size: 0.9rem;">
                    <i class="bi bi-info-circle"></i>
                    <strong>Catatan:</strong>
                    Khusus produk RTE periksa kondisi hasil sealing (tidak miring, tidak melipat, minimal lebar seal 1 cm) dan kondisi pouch tidak bocor. Tuliskan hasil pemeriksaan di kolom <u>Keterangan</u>.
                </div>

                <div class="alert alert-danger mt-2 py-2 px-3" style="font-size: 0.9rem;">
                    <i class="bi bi-info-circle"></i>
                    <strong>Catatan:</strong>
                    Upload gambar pada Kode Produksi dan Best Before untuk bukti saat melakukan checking atau packing.
                </div>

                {{-- Bagian CHECKING --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white text-center">
                        <strong>PENGEMASAN - CHECKING</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" name="date" class="form-control" value="{{ $pengemasan->date }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Shift</label>
                                        <select name="shift" class="form-control" required>
                                            <option value="1" {{ $pengemasan->shift == 1 ? 'selected' : '' }}>Shift 1</option>
                                            <option value="2" {{ $pengemasan->shift == 2 ? 'selected' : '' }}>Shift 2</option>
                                            <option value="3" {{ $pengemasan->shift == 3 ? 'selected' : '' }}>Shift 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pukul</label>
                                        <input type="time" name="pukul" class="form-control" value="{{ $pengemasan->pukul }}" required>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered table-sm mb-0 text-center align-middle table-pengemasan">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="4" class="separator">Tray / Pack</th>
                                        <th colspan="2">Box</th>
                                        <th rowspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Prod. Code | Best Before</th>
                                        <th>QR Code</th>
                                        <th class="separator">Kondisi</th>
                                        <th>Nama Produk | Prod. Code | Best Before</th>
                                        <th>Kondisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- Tray --}}
                                        <td><input type="text" name="tray_checking[nama_produk]" class="form-control form-control-sm" value="{{ $trayChecking['nama_produk'] ?? '' }}"></td>
                                        <td>
                                            <input type="file" name="tray_checking[kode_produksi]" class="form-control form-control-sm"><br>
                                            @if(!empty($trayChecking['kode_produksi']))
                                            <a href="{{ asset('storage/'.$trayChecking['kode_produksi']) }}" target="_blank">Lihat File</a>
                                            @endif
                                        </td>
                                        <td>
                                            <select name="tray_checking[qrcode]" class="form-control form-control-sm">
                                                <option value="sesuai" {{ ($trayChecking['qrcode'] ?? '') == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                                                <option value="tidak sesuai" {{ ($trayChecking['qrcode'] ?? '') == 'tidak sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                            </select>
                                        </td>
                                        <td class="separator">
                                            <select name="tray_checking[kondisi]" class="form-control form-control-sm">
                                                <option value="oke" {{ ($trayChecking['kondisi'] ?? '') == 'oke' ? 'selected' : '' }}>Oke</option>
                                                <option value="tidak oke" {{ ($trayChecking['kondisi'] ?? '') == 'tidak oke' ? 'selected' : '' }}>Tidak Oke</option>
                                            </select>
                                        </td>

                                        {{-- Box --}}
                                        <td>
                                            <input type="file" name="box_checking[kode_produksi]" class="form-control form-control-sm"><br>
                                            @if(!empty($boxChecking['kode_produksi']))
                                            <a href="{{ asset('storage/'.$boxChecking['kode_produksi']) }}" target="_blank">Lihat File</a>
                                            @endif
                                        </td>
                                        <td>
                                            <select name="box_checking[kondisi]" class="form-control form-control-sm">
                                                <option value="oke" {{ ($boxChecking['kondisi'] ?? '') == 'oke' ? 'selected' : '' }}>Oke</option>
                                                <option value="tidak oke" {{ ($boxChecking['kondisi'] ?? '') == 'tidak oke' ? 'selected' : '' }}>Tidak Oke</option>
                                            </select>
                                        </td>

                                        {{-- Keterangan --}}
                                        <td><input type="text" name="keterangan_checking" class="form-control form-control-sm" value="{{ $pengemasan->keterangan_checking }}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- Bagian PACKING --}}
                <div class="card mb-3">
                    <div class="card-header bg-success text-white text-center">
                        <strong>PENGEMASAN - PACKING</strong>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" name="date_packing" class="form-control" value="{{ $pengemasan->date_packing }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Shift</label>
                                        <select name="shift_packing" class="form-control">
                                            <option value="">Pilih Shift</option>
                                            <option value="1" {{ $pengemasan->shift_packing == 1 ? 'selected' : '' }}>Shift 1</option>
                                            <option value="2" {{ $pengemasan->shift_packing == 2 ? 'selected' : '' }}>Shift 2</option>
                                            <option value="3" {{ $pengemasan->shift_packing == 3 ? 'selected' : '' }}>Shift 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Pukul</label>
                                        <input type="time" name="pukul_packing" class="form-control" value="{{ $pengemasan->pukul_packing }}">
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered table-sm mb-0 text-center align-middle table-pengemasan">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="4" class="separator">Tray / Pack</th>
                                        <th colspan="3">Box</th>
                                        <th rowspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Prod. Code | Best Before</th>
                                        <th>QR Code</th>
                                        <th class="separator">Kondisi</th>
                                        <th>Nama Produk | Prod. Code | Best Before</th>
                                        <th>Isi Box</th>
                                        <th>Kondisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- Tray --}}
                                        <td><input type="text" name="tray_packing[nama_produk]" class="form-control form-control-sm" value="{{ $trayPacking['nama_produk'] ?? '' }}"></td>
                                        <td>
                                            <input type="file" name="tray_packing[kode_produksi]" class="form-control form-control-sm"><br>
                                            @if(!empty($trayPacking['kode_produksi']))
                                            <a href="{{ asset('storage/'.$trayPacking['kode_produksi']) }}" target="_blank">Lihat File</a>
                                            @endif
                                        </td>
                                        <td>
                                            <select name="tray_packing[qrcode]" class="form-control form-control-sm">
                                                <option value="">Pilihan</option>
                                                <option value="sesuai" {{ ($trayPacking['qrcode'] ?? '') == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                                                <option value="tidak sesuai" {{ ($trayPacking['qrcode'] ?? '') == 'tidak sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                            </select>
                                        </td>
                                        <td class="separator">
                                            <select name="tray_packing[kondisi]" class="form-control form-control-sm">
                                                <option value="">Pilihan</option>
                                                <option value="oke" {{ ($trayPacking['kondisi'] ?? '') == 'oke' ? 'selected' : '' }}>Oke</option>
                                                <option value="tidak oke" {{ ($trayPacking['kondisi'] ?? '') == 'tidak oke' ? 'selected' : '' }}>Tidak Oke</option>
                                            </select>
                                        </td>

                                        {{-- Box --}}
                                        <td>
                                            <input type="file" name="box_packing[kode_produksi]" class="form-control form-control-sm"><br>
                                            @if(!empty($boxPacking['kode_produksi']))
                                            <a href="{{ asset('storage/'.$boxPacking['kode_produksi']) }}" target="_blank">Lihat File</a>
                                            @endif
                                        </td>
                                        <td><input type="number" name="box_packing[isi_box]" class="form-control form-control-sm" value="{{ $boxPacking['isi_box'] ?? '' }}"></td>
                                        <td>
                                            <select name="box_packing[kondisi]" class="form-control form-control-sm">
                                                <option value="">Pilihan</option>
                                                <option value="oke" {{ ($boxPacking['kondisi'] ?? '') == 'oke' ? 'selected' : '' }}>Oke</option>
                                                <option value="tidak oke" {{ ($boxPacking['kondisi'] ?? '') == 'tidak oke' ? 'selected' : '' }}>Tidak Oke</option>
                                            </select>
                                        </td>

                                        {{-- Keterangan --}}
                                        <td><input type="text" name="keterangan_packing" class="form-control form-control-sm" value="{{ $pengemasan->keterangan_packing }}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <strong>Catatan</strong>
                    </div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3">{{ $pengemasan->catatan }}</textarea>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-success w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('pengemasan.index') }}" class="btn btn-secondary w-auto">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jQuery & bootstrap-select --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
    $('#nama_produk').on('change', function () {
      let selectedNama = $(this).val();
      $('input[name="tray_checking[nama_produk]"]').val(selectedNama);
  });
</script>
<style>
    .table-pengemasan {
        min-width: 1800px;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-pengemasan th,
    .table-pengemasan td {
        min-width: 150px;
        padding: 1rem;
    }
    .table-pengemasan .separator {
        border-right: 1px solid grey;
    }
    .table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-align: center;
    }
</style>
@endsection
