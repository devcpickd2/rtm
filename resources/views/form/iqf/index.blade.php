@extends('layouts.app')

@section('content')
<div class="container-fluid py-0">
    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ trim(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif 

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-list-check"></i> Data Pemeriksaan Suhu Produk setelah IQF</h3>
                <a href="{{ route('iqf.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Search --}}
            <form method="GET" action="{{ route('iqf.index') }}" class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="date" name="start_date" class="form-control"
                    value="{{ request('start_date') }}" placeholder="Tanggal awal">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" class="form-control"
                    value="{{ request('end_date') }}" placeholder="Tanggal akhir">
                </div>
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control"
                    value="{{ request('search') }}" placeholder="Cari Nama Produk/Kode Produksi...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('iqf.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>

            {{-- Tambahkan table-responsive agar tabel tidak keluar border --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                       <tr>
                        <th>NO.</th>
                        <th>Date | Shift</th>
                        <th>Pukul</th>
                        <th>Nama Produk</th>
                        <th>Kode Produksi</th>
                        <th>Std CT (°C)</th>
                        <th>Suhu Pusat Produk (°C)</th>
                        <th>Problem</th>
                        <th>Tindakan Koreksi</th>
                        <th>Catatan</th>
                        <th>Produksi</th>
                        <th>SPV</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $no = ($data->currentPage() - 1) * $data->perPage() + 1; 
                    @endphp
                    @forelse ($data as $dep)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | Shift: {{ $dep->shift }}</td>   
                        <td>{{ \Carbon\Carbon::parse($dep->pukul)->format('H:i') }}</td>
                        <td>{{ $dep->nama_produk }}</td>
                        <td class="text-center">{{ $dep->kode_produksi }}</td>
                        <td class="text-center">{{ $dep->std_suhu }}</td>
                        @foreach($data as $dep)
                        @php
                        $suhu_pusat = $dep->suhu_pusat ?? [];

                        // Ambil 10 value dan ket
                        $values = [];
                        $kets   = [];
                        for ($i = 1; $i <= 10; $i++) {
                            $val = $suhu_pusat[$i]['value'] ?? null;
                            $ket = $suhu_pusat[$i]['ket'] ?? null;

                            $values[$i] = $val;
                            $kets[$i]   = $ket;
                        }

                        // Hitung rata-rata value numeric
                        $numericVals = array_filter($values, fn($v) => is_numeric($v));
                        $avg = count($numericVals) ? array_sum($numericVals)/count($numericVals) : null;
                        @endphp

                        <td class="text-center">
                            @if(!empty($suhu_pusat))
                            <a href="#" data-bs-toggle="modal" data-bs-target="#suhuPusatModal{{ $dep->uuid }}" style="font-weight:bold;text-decoration:underline;">
                                Hasil Suhu Pusat
                            </a>

                            <div class="modal fade" id="suhuPusatModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="suhuPusatModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="max-width:90%;">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title text-start" id="suhuPusatModalLabel{{ $dep->uuid }}">Detail Pemeriksaan Suhu IQF</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm text-center align-middle">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th colspan="10">Suhu Pusat (°C)</th>
                                                            <th>Avg</th>
                                                        </tr>
                                                        <tr>
                                                            @for($i=1;$i<=10;$i++)
                                                            <th>{{ $i }}</th>
                                                            @endfor
                                                            <th>Rata²</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @php 
                                                            $std = is_numeric($dep->std_suhu) ? $dep->std_suhu : null;
                                                            @endphp
                                                            @for($i=1;$i<=10;$i++)
                                                            @php
                                                            $val = $values[$i];
                                                            $ket = $kets[$i];
                                                            @endphp
                                                            <td>
                                                                {{-- Nilai --}}
                                                                @if($val !== null && $std !== null && is_numeric($val) && $val > $std)
                                                                <strong class="text-danger">{{ $val }}</strong>
                                                                @elseif($val !== null)
                                                                <strong>{{ $val }}</strong>
                                                                @else
                                                                -
                                                                @endif

                                                                {{-- Ket --}}
                                                                @if(!empty($ket))
                                                                <br>
                                                                <small class="text-muted">{{ $ket }}</small>
                                                                @endif
                                                            </td>
                                                            @endfor

                                                            {{-- Kolom rata-rata --}}
                                                            <td>
                                                                @if($avg && $std && $avg > $std)
                                                                <strong class="text-danger">{{ number_format($avg,2) }}</strong>
                                                                @elseif($avg)
                                                                <strong>{{ number_format($avg,2) }}</strong>
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <span>-</span>
                            @endif
                        </td>
                        @endforeach

                        <td>{{ $dep->problem ?? '-' }}</td>
                        <td>{{ $dep->tindakan_koreksi ?? '-' }}</td>
                        <td>{{ $dep->catatan ?? '-' }}</td>

                        <td class="text-center align-middle">
                            @if ($dep->status_produksi == 0)
                            <span class="fw-bold text-secondary">Created</span>
                            @elseif ($dep->status_produksi == 1)
                            <!-- Link buka modal -->
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#checkedModal{{ $dep->uuid }}" 
                                class="fw-bold text-success text-decoration-none" style="cursor: pointer; font-weight: bold;">Checked</a>

                                <!-- Modal -->
                                <div class="modal fade" id="checkedModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="checkedModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title" id="checkedModalLabel{{ $dep->uuid }}">Detail Checked</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled mb-0">
                                                    <li><strong>Status:</strong> Checked</li>
                                                    <li><strong>Nama Produksi:</strong> {{ $dep->nama_produksi ?? '-' }}</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($dep->status_produksi == 2)
                                <span class="fw-bold text-danger">Recheck</span>
                                @endif
                            </td>

                            <td class="text-center align-middle">
                                @if ($dep->status_spv == 0)
                                <span class="fw-bold text-secondary">Created</span>
                                @elseif ($dep->status_spv == 1)
                                <span class="fw-bold text-success">Verified</span>
                                @elseif ($dep->status_spv == 2)
                                <!-- Link buka modal -->
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#revisionModal{{ $dep->uuid }}" 
                                 class="text-danger fw-bold text-decoration-none" style="cursor: pointer;">Revision</a>

                                 <!-- Modal -->
                                 <div class="modal fade" id="revisionModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="revisionModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="revisionModalLabel{{ $dep->uuid }}">Detail Revisi</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-unstyled mb-0">
                                                    <li><strong>Status:</strong> Revision</li>
                                                    <li><strong>Catatan:</strong> {{ $dep->catatan_spv ?? '-' }}</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>


                            <td class="text-center">
                                <a href="{{ route('iqf.edit', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('iqf.destroy', $dep->uuid) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="25" class="text-center">Belum ada data produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</div>

{{-- Auto-hide alert setelah 3 detik --}}
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert){
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 3000);
</script>

{{-- CSS tambahan agar tabel lebih rapi --}}
<style>
    .table td, .table th {
        font-size: 0.85rem;
        white-space: nowrap; 
    }
    .text-danger {
        font-weight: bold;
    }
    .text-muted.fst-italic {
        color: #6c757d !important;
        font-style: italic !important;
    }
    .container {
        padding-left: 2px !important;
        padding-right: 2px !important;
    }
</style>
@endsection
