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
                <h3><i class="bi bi-list-check"></i> Data Pemeriksaan Proses Thumbling</h3>
                <a href="{{ route('thumbling.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Filter dan Search --}}
            <form method="GET" action="{{ route('thumbling.index') }}" class="row g-2 mb-3">
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
                    <a href="{{ route('thumbling.index') }}" class="btn btn-secondary w-100">
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
                            <th>Nama Produk</th>
                            <th>Thumbling</th>
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
                            <td>{{ $dep->nama_produk }}</td>
                            {{-- Bagian Tampilkan Thumbling --}}
                            <td class="text-center">
                                @php
                                $thumbls = $dep->thumbls_decoded ?? [];
                                @endphp

                                {{-- Tombol Detail Thumbling --}}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#thumblingModal{{ $dep->uuid }}"
                                 style="font-weight: bold; text-decoration: underline;">
                                 Detail Thumbling
                             </a>

                             {{-- Modal Detail Thumbling --}}
                             <div class="modal fade" id="thumblingModal{{ $dep->uuid }}" tabindex="-1"
                               aria-labelledby="thumblingModalLabel{{ $dep->uuid }}" aria-hidden="true">
                               <div class="modal-dialog modal-xl">
                                <div class="modal-content">

                                    {{-- Header --}}
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title" id="thumblingModalLabel{{ $dep->uuid }}">Detail Thumbling</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    {{-- Body --}}
                                    <div class="modal-body">
                                        @if(count($thumbls))
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm text-center align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Parameter</th>
                                                        @foreach($thumbls as $index => $batch)
                                                        <th>Batch {{ $index + 1 }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- Informasi Umum --}}
                                                    <tr>
                                                        <td class="text-left"><strong>BATCH NO.</strong></td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['batch'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><strong>IDENTIFIKASI DAGING</strong></td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['daging'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Asal</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['asal'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>

                                                    {{-- Kode Daging --}}
                                                    <tr>
                                                        <td class="text-left">Tanggal Produksi / Kode</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            @if(!empty($batch['kode_daging']))
                                                            @foreach($batch['kode_daging'] as $kd)
                                                            {{ $kd['kode'] ?? '-' }}<br>
                                                            @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Berat (kg)</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            @if(!empty($batch['kode_daging']))
                                                            @foreach($batch['kode_daging'] as $kd)
                                                            {{ $kd['berat'] ?? '-' }}<br>
                                                            @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Suhu Daging (0-10°C)</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            @if(!empty($batch['kode_daging']))
                                                            @foreach($batch['kode_daging'] as $kd)
                                                            {{ !empty($kd['suhu_daging']) ? implode(', ', $kd['suhu_daging']) : '-' }}<br>
                                                            @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Rata-rata</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            @if(!empty($batch['kode_daging']))
                                                            @foreach($batch['kode_daging'] as $kd)
                                                            {{ $kd['rata_rata_suhu'] ?? '-' }}<br>
                                                            @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Kondisi Daging</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            @if(!empty($batch['kode_daging']))
                                                            @foreach($batch['kode_daging'] as $kd)
                                                            {{ $kd['kondisi_daging'] ?? '-' }}<br>
                                                            @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    </tr>

                                                    {{-- Bahan Utama --}}
                                                    <tr>
                                                        <td class="text-left"><strong>Bahan Utama</strong></td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            @if(!empty($batch['bahan_utama']))
                                                            @foreach($batch['bahan_utama'] as $bu)
                                                            {{ $bu['bahan'] ?? '-' }} ({{ $bu['kode'] ?? '-' }}) - {{ $bu['berat'] ?? '-' }} kg<br>
                                                            @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    </tr>

                                                    {{-- Bahan Lain --}}
                                                    <tr>
                                                        <td class="text-left"><strong>Bahan Lain</strong></td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            @if(!empty($batch['bahan_lain']))
                                                            @foreach($batch['bahan_lain'] as $bl)
                                                            {{ $bl['premix'] ?? '-' }} ({{ $bl['kode'] ?? '-' }}) - {{ $bl['berat'] ?? '-' }} kg [{{ $bl['sens'] ?? '-' }}]<br>
                                                            @endforeach
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                    </tr>

                                                    {{-- Parameter Cairan --}}
                                                    <tr>
                                                        <td class="text-left">Air (kg)</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['air'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Suhu air (°C)</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['suhu_air'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Suhu marinade (°C)</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['suhu_marinade'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Lama Pengadukan (menit)</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['lama_pengadukan'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Marinade Brix – Salinity</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['brix'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>

                                                    {{-- Parameter Tumbling --}}
                                                    <tr>
                                                        <td class="text-left"><strong>PARAMETER THUMBLING</strong></td>
                                                        @foreach($thumbls as $batch)<td>-</td>@endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Drum On (Menit)</td>
                                                        @foreach($thumbls as $batch)<td>{{ $batch['drum_on'] ?? '-' }}</td>@endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Drum Off</td>
                                                        @foreach($thumbls as $batch)<td>{{ $batch['drum_off'] ?? '-' }}</td>@endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Drum Speed (RPM)</td>
                                                        @foreach($thumbls as $batch)<td>{{ $batch['drum_speed'] ?? '-' }}</td>@endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Vacuum Time (Menit)</td>
                                                        @foreach($thumbls as $batch)<td>{{ $batch['vacuum_time'] ?? '-' }}</td>@endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Total Time (Menit)</td>
                                                        @foreach($thumbls as $batch)<td>{{ $batch['total_time'] ?? '-' }}</td>@endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Mulai - Selesai</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['mulai'] ?? '-' }} - {{ $batch['selesai'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>

                                                    {{-- Hasil Tumbling --}}
                                                    <tr>
                                                        <td class="text-left"><strong>HASIL THUMBLING</strong></td>
                                                        @foreach($thumbls as $batch)<td>-</td>@endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Suhu Daging (°C)</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>
                                                            {{ !empty($batch['hasil_tumbling']['suhu_daging']) ? implode(', ', $batch['hasil_tumbling']['suhu_daging']) : '-' }}
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left">Rata-rata</td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['hasil_tumbling']['rata_rata'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>

                                                    {{-- Kondisi & Catatan --}}
                                                    <tr>
                                                        <td class="text-left"><strong>Kondisi</strong></td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['kondisi'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left"><strong>Catatan</strong></td>
                                                        @foreach($thumbls as $batch)
                                                        <td>{{ $batch['catatan'] ?? '-' }}</td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <p class="text-center text-muted">Belum ada data thumbling.</p>
                                        @endif
                                    </div>

                                    {{-- Footer --}}
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </td>


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
                            <a href="{{ route('thumbling.edit', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('thumbling.destroy', $dep->uuid) }}" method="POST" class="d-inline">
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
                    <td colspan="19" class="text-center">Belum ada data thumbling.</td>
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
