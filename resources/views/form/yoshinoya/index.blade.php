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
                <h3><i class="bi bi-list-check"></i> Data Parameter Produk Saus Yoshinoya</h3>
                <a href="{{ route('yoshinoya.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Search --}}
            <form method="GET" action="{{ route('yoshinoya.index') }}" class="row g-2 mb-3">
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
                    value="{{ request('search') }}" placeholder="Cari nama bahan/kode produksi...">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                    <a href="{{ route('yoshinoya.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>

            {{-- Tambahkan table-responsive agar tabel tidak keluar border --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th rowspan="3">NO.</th>
                            <th rowspan="2">Tanggal Produksi</th>
                            <th>Kode Produksi</th>
                            <th>Suhu Pengukuran (°C)</th>
                            <th>Brix (%)</th>
                            <th>Salt (%)</th>
                            <th>Viscocitas (detik.milidetik)</th>
                            <th>Brookfield LV, S 64,. 30% RPM suhu saus 24 - 26°C</th>
                            <th>Brookfield LV, S 64,. 30% RPM (Setelah Frozen) suhu saus 24 - 26°C</th>
                            <th rowspan="3">Produksi</th>
                            <th rowspan="3">SPV</th>
                            <th rowspan="3">Action</th>
                        </tr>
                        <tr>
                            <th>Vegetable</th>
                            <th rowspan="2">24 - 26</th>
                            <th>6 - 12</th>
                            <th>6 - 12</th>
                            <th>20 - 50</th>
                            <th>1000 - 3000 Cp</th>
                            <th>1000 - 3000 Cp</th>
                        </tr>
                        <tr>
                            <th>Shift</th>
                            <th>Teriyaki</th>
                            <th>33 - 38</th>
                            <th>14 - 17</th>
                            <th>70 - 130</th>
                            <th>3000 - 5000 Cp</th>
                            <th>2500 - 3000 Cp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                        $no = ($data->currentPage() - 1) * $data->perPage() + 1; 

                        @endphp
                        @forelse ($data as $dep)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }} | {{ $dep->shift }}</td>
                            <td>{{ $dep->kode_produksi }}</td>
                            <td>{{ $dep->suhu_pengukuran }}</td>
                            <td>{{ $dep->brix }}</td>
                            <td>{{ $dep->salt }}</td>
                            <td>{{ $dep->visco }}</td>
                            <td>{{ $dep->brookfield_sebelum }}</td>
                            <td>{{ $dep->brookfield_frozen }}</td>
                            <td>
                                @if ($dep->status_produksi == 0)
                                <span style="font-weight: bold;" class="text-secondary">Created</span>
                                @elseif ($dep->status_produksi == 1)
                                <span style="font-weight: bold;" class="text-success">Checked</span>
                                @elseif ($dep->status_produksi == 2)
                                <span style="font-weight: bold;" class="text-danger">Recheck</span>
                                @endif
                            </td>

                            <td>
                                @if ($dep->status_spv == 0)
                                <span style="font-weight: bold;" class="text-secondary">Created</span>
                                @elseif ($dep->status_spv == 1)
                                <span style="font-weight: bold;" class="text-success">Verified</span>
                                @elseif ($dep->status_spv == 2)
                                <span style="font-weight: bold;" class="text-danger">Revision</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('yoshinoya.edit', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('yoshinoya.destroy', $dep->uuid) }}" method="POST" class="d-inline">
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
                        <td colspan="19" class="text-center">Belum ada data yoshinoya.</td>
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
