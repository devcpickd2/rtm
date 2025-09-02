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
                <h3><i class="bi bi-list-check"></i> Data GMP Karyawan</h3>
                <a href="{{ route('gmp.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Search --}}
            <form method="GET" action="{{ route('gmp.index') }}" class="row g-2 mb-3">
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
                    <a href="{{ route('gmp.index') }}" class="btn btn-secondary w-100">
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
                            <th>Date</th>
                            <th>Noodle & Rice</th>
                            <th>Cooking</th>
                            <th>Packing</th>
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
                            <td>{{ \Carbon\Carbon::parse($dep->date)->format('d-m-Y') }}</td>   
                            @php
                            function hitungPresentase($json) {
                                if (!$json) return 0;

                                $data = is_array($json) ? $json : json_decode($json, true);
                                if (!$data) return 0;

                                $total = 0;
                                $count = 0;

                                foreach ($data as $row) {
                                    foreach ($row as $key => $val) {
                                        if ($key !== 'nama_karyawan') {
                                            $total++;
                                            if ($val == 1) {
                                                $count++;
                                            }
                                        }
                                    }
                                }

                                return $total > 0 ? round(($count / $total) * 100, 1) : 0;
                            }

                            function topKaryawan($json, $limit = 3) {
                                if (!$json) return [];

                                $data = is_array($json) ? $json : json_decode($json, true);
                                if (!$data) return [];

                                $scores = [];
                                foreach ($data as $row) {
                                    $nama = $row['nama_karyawan'] ?? 'Tanpa Nama';
                                    $count = 0;
                                    foreach ($row as $key => $val) {
                                        if ($key !== 'nama_karyawan' && $val == 1) {
                                            $count++;
                                        }
                                    }
                                    $scores[] = [
                                    'nama' => $nama,
                                    'nilai' => $count
                                    ];
                                }

                                // urutkan berdasarkan nilai tertinggi
                                usort($scores, function($a, $b) {
                                    return $b['nilai'] <=> $a['nilai'];
                                    });

                                    return array_slice($scores, 0, $limit);
                                }
                                @endphp

                                {{-- Pemakaian di tabel --}}
                                <td>
                                    {{ hitungPresentase($dep->noodle_rice) }} %
                                    <br>
                                    <small>
                                        @foreach(topKaryawan($dep->noodle_rice) as $row)
                                        • {{ $row['nama'] }} ({{ $row['nilai'] }})<br>
                                        @endforeach
                                    </small>
                                </td>

                                <td>
                                    {{ hitungPresentase($dep->cooking) }} %
                                    <br>
                                    <small>
                                        @foreach(topKaryawan($dep->cooking) as $row)
                                        • {{ $row['nama'] }} ({{ $row['nilai'] }})<br>
                                        @endforeach
                                    </small>
                                </td>

                                <td>
                                    {{ hitungPresentase($dep->packing) }} %
                                    <br>
                                    <small>
                                        @foreach(topKaryawan($dep->packing) as $row)
                                        • {{ $row['nama'] }} ({{ $row['nilai'] }})<br>
                                        @endforeach
                                    </small>
                                </td>
                                
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
                                    <a href="{{ route('gmp.edit', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('gmp.destroy', $dep->uuid) }}" method="POST" class="d-inline">
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
                            <td colspan="19" class="text-center">Belum ada data gmp karyawan.</td>
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
