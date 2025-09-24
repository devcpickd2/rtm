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
                <h3><i class="bi bi-list-check"></i> Data Tahapan Suhu Produk Setiap Tahapan Proses</h3>
                <a href="{{ route('tahapan.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Search --}}
            <form method="GET" action="{{ route('tahapan.index') }}" class="row g-2 mb-3">
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
                    <a href="{{ route('tahapan.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>

            {{-- Tambahkan table-responsive agar tabel tidak keluar border --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                     <tr>
                        <th rowspan="2">NO.</th>
                        <th rowspan="2">Date | Shift</th>
                        <th rowspan="2">Nama Produk</th>
                        <th rowspan="2">Kode Produksi</th>
                        <th colspan="8">JAM MULAI</th>
                        <th colspan="9">SUHU PRODUK (°C)</th>
                        <th rowspan="2">Catatan</th>
                        <th rowspan="2">Produksi</th>
                        <th rowspan="2">SPV</th>
                        <th rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>Filling/Portioning</th>
                        <th>IQF</th>
                        <th>Top Sealer</th>
                        <th>X-Ray</th>
                        <th>Sticker</th>
                        <th>Shrink</th>
                        <th>Packing Box</th>
                        <th>Cold Storage</th>

                        <th>Filling</th>
                        <th>Masuk IQF</th>
                        <th>Keluar IQF</th>
                        <th>Top Sealer</th>
                        <th>X-Ray</th>
                        <th>Sticker</th>
                        <th>Shrink</th>
                        <th>Downtime</th>
                        <th>Cold Storage</th>
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
                        <td>{{ $dep->nama_produk }}</td>
                        <td class="text-center">{{ $dep->kode_produksi }}</td>
                        <td class="text-center">
                            {{ $dep->filling_mulai ? \Carbon\Carbon::parse($dep->filling_mulai)->format('H:i') : '-' }} -
                            {{ $dep->filling_selesai ? \Carbon\Carbon::parse($dep->filling_selesai)->format('H:i') : '-' }}
                        </td>
                        <td class="text-center">{{ $dep->waktu_iqf ? \Carbon\Carbon::parse($dep->waktu_iqf)->format('H:i') : '-' }}</td>
                        <td class="text-center">{{ $dep->waktu_sealer ? \Carbon\Carbon::parse($dep->waktu_sealer)->format('H:i') : '-' }}</td>
                        <td class="text-center">{{ $dep->waktu_xray ? \Carbon\Carbon::parse($dep->waktu_xray)->format('H:i') : '-' }}</td>
                        <td class="text-center">{{ $dep->waktu_sticker ? \Carbon\Carbon::parse($dep->waktu_sticker)->format('H:i') : '-' }}</td>
                        <td class="text-center">{{ $dep->waktu_shrink ? \Carbon\Carbon::parse($dep->waktu_shrink)->format('H:i') : '-' }}</td>
                        <td class="text-center">{{ $dep->waktu_packing ? \Carbon\Carbon::parse($dep->waktu_packing)->format('H:i') : '-' }}</td>
                        <td class="text-center">{{ $dep->waktu_cs ? \Carbon\Carbon::parse($dep->waktu_cs)->format('H:i') : '-' }}</td>

                        <td class="text-center">
                            @php
                            // Pastikan selalu array agar foreach tidak error
                            $suhu_filling = $dep->suhu_filling;

                            if (is_string($suhu_filling)) {
                                $decoded = json_decode($suhu_filling, true);
                                $suhu_filling = is_array($decoded) ? $decoded : [];
                            } elseif (!is_array($suhu_filling)) {
                                $suhu_filling = [];
                            }
                            @endphp

                            @if(!empty($suhu_filling))
                            <a href="#" data-bs-toggle="modal" data-bs-target="#suhu_fillingModal{{ $dep->uuid }}" style="font-weight: bold; text-decoration: underline;">
                                Result
                            </a>

                            <div class="modal fade" id="suhu_fillingModal{{ $dep->uuid }}" tabindex="-1" aria-labelledby="suhu_fillingModalLabel{{ $dep->uuid }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title text-start" id="suhu_fillingModalLabel{{ $dep->uuid }}">
                                                Detail Pengecekan Suhu Filling
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th style="width:50px;">No</th>
                                                            <th>Nama Bahan</th>
                                                            <th>Suhu (°C)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($suhu_filling as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item['nama_bahan'] ?? '-' }}</td>
                                                            <td>{{ $item['suhu'] ?? '-' }}°C</td>
                                                        </tr>
                                                        @endforeach
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

                        <td class="text-center">{{ $dep->suhu_masuk_iqf ?? '-' }}</td>
                        <td class="text-center">{{ $dep->suhu_keluar_iqf ?? '-' }}</td>
                        <td class="text-center">{{ $dep->suhu_sealer ?? '-' }}</td>
                        <td class="text-center">{{ $dep->suhu_xray ?? '-' }}</td>
                        <td class="text-center">{{ $dep->suhu_sticker ?? '-' }}</td>
                        <td class="text-center">{{ $dep->suhu_shrink ?? '-' }}</td>
                        <td class="text-center">{{ $dep->downtime ?? '-' }}</td>
                        <td class="text-center">{{ $dep->suhu_cs ?? '-' }}</td>
                        <td class="text-center">{{ $dep->keterangan ?? '-' }}</td>

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
                                <a href="{{ route('tahapan.edit', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('tahapan.destroy', $dep->uuid) }}" method="POST" class="d-inline">
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
                        <td colspan="25" class="text-center">Belum ada data proses.</td>
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
