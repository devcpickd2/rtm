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
                <h3><i class="bi bi-list-check"></i> Data Pemeriksaan Suhu Ruang</h3>
                <a href="{{ route('suhu.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Search --}}
            <form method="GET" action="{{ route('suhu.index') }}" class="row g-2 mb-3">
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
                    value="{{ request('search') }}" placeholder="Cari shift/catatan...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('suhu.index') }}" class="btn btn-secondary w-100">
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
                            <th>Chillroom<br><small>(0–4 °C)</small></th>
                            <th>Cold Stor.<br>1<br><small>(-22 – (-18) °C)</small></th>
                            <th>Cold Stor.<br>2<br><small>(-22 – (-18) °C)</small></th>
                            <th>Anteroom<br>RM<br><small>(8–10 °C)</small></th>
                            <th>Seasoning<br><small>(22–30 °C / ≤75% RH)</small></th>
                            <th>Prep.<br>Room<br><small>(9–15 °C)</small></th>
                            <th>Cooking<br><small>(20–30 °C)</small></th>
                            <th>Filling<br><small>(9–15 °C)</small></th>
                            <th>Rice<br><small>(20–30 °C)</small></th>
                            <th>Noodle<br><small>(20–30 °C)</small></th>
                            <th>Topping<br><small>(9–15 °C)</small></th>
                            <th>Packing<br><small>(9–15 °C)</small></th>
                            <th>DS<br><small>(20–30 °C / ≤75% RH)</small></th>
                            <th>Cold Stor.<br>FG<br><small>(-20 – (-18) °C)</small></th>
                            <th>Anteroom<br>FG<br><small>(0–10 °C)</small></th>
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
                            <td>{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | Shift: {{ $dep->shift }}</td>
                            <td>{{ \Carbon\Carbon::parse($dep->pukul)->format('H:i') }}</td>

                            {{-- Chillroom 0-4 --}}
                            <td class="{{ cekRange($dep->chillroom,0,4) }}">{{ $dep->chillroom ?? 'Belum dicek' }}</td>
                            {{-- CS1 -22 s/d -18 --}}
                            <td class="{{ cekRange($dep->cs_1,-22,-18) }}">{{ $dep->cs_1 ?? 'Belum dicek' }}</td>
                            {{-- CS2 -22 s/d -18 --}}
                            <td class="{{ cekRange($dep->cs_2,-22,-18) }}">{{ $dep->cs_2 ?? 'Belum dicek' }}</td>
                            {{-- Anteroom RM 8-10 --}}
                            <td class="{{ cekRange($dep->anteroom_rm,8,10) }}">{{ $dep->anteroom_rm ?? 'Belum dicek' }}</td>
                            {{-- Seasoning Suhu 22-30 | RH <=75 --}}
                            <td>
                                <span class="{{ cekRange($dep->seasoning_suhu,22,30) }}">{{ $dep->seasoning_suhu ?? 'Belum dicek' }}</span> | 
                                <span class="{{ cekRange($dep->seasoning_rh,0,75) }}">{{ $dep->seasoning_rh ?? 'Belum dicek' }}</span>
                            </td>
                            {{-- Prep Room 9-15 --}}
                            <td class="{{ cekRange($dep->prep_room,9,15) }}">{{ $dep->prep_room ?? 'Belum dicek' }}</td>
                            {{-- Cooking 20-30 --}}
                            <td class="{{ cekRange($dep->cooking,20,30) }}">{{ $dep->cooking ?? 'Belum dicek' }}</td>
                            {{-- Filling 9-15 --}}
                            <td class="{{ cekRange($dep->filling,9,15) }}">{{ $dep->filling ?? 'Belum dicek' }}</td>
                            {{-- Rice 20-30 --}}
                            <td class="{{ cekRange($dep->rice,20,30) }}">{{ $dep->rice ?? 'Belum dicek' }}</td>
                            {{-- Noodle 20-30 --}}
                            <td class="{{ cekRange($dep->noodle,20,30) }}">{{ $dep->noodle ?? 'Belum dicek' }}</td>
                            {{-- Topping 9-15 --}}
                            <td class="{{ cekRange($dep->topping,9,15) }}">{{ $dep->topping ?? 'Belum dicek' }}</td>
                            {{-- Packing 9-15 --}}
                            <td class="{{ cekRange($dep->packing,9,15) }}">{{ $dep->packing ?? 'Belum dicek' }}</td>
                            {{-- DS Suhu 20-30 | RH <=75 --}}
                            <td>
                                <span class="{{ cekRange($dep->ds_suhu,20,30) }}">{{ $dep->ds_suhu ?? 'Belum dicek' }}</span> | 
                                <span class="{{ cekRange($dep->ds_rh,0,75) }}">{{ $dep->ds_rh ?? 'Belum dicek' }}</span>
                            </td>
                            {{-- CS FG -20 s/d -18 --}}
                            <td class="{{ cekRange($dep->cs_fg,-20,-18) }}">{{ $dep->cs_fg ?? 'Belum dicek' }}</td>
                            {{-- Anteroom FG 0-10 --}}
                            <td class="{{ cekRange($dep->anteroom_fg,0,10) }}">{{ $dep->anteroom_fg ?? 'Belum dicek' }}</td>
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
                                    <a href="{{ route('suhu.edit', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('suhu.destroy', $dep->uuid) }}" method="POST" class="d-inline">
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
                            <td colspan="19" class="text-center">Belum ada data suhu.</td>
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
    /* Header tabel merah */
    .table thead {
        background-color: #dc3545 !important; /* merah gelap */
        color: #fff;
    }

/* Baris tabel stripe merah muda */
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f8d7da; /* merah muda terang */
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: #f5c2c7; /* merah muda agak gelap */
}

/* Hover baris merah gelap */
.table tbody tr:hover {
    background-color: #e4606d !important;
    color: #fff;
}

/* Border tabel merah */
.table-bordered th, .table-bordered td {
    border-color: #dc3545;
}

/* Tombol aksi tetap jelas */
.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #b02a37;
    border-color: #a52834;
}
</style>
@endsection
