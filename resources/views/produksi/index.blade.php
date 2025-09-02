@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ trim(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3><i class="bi bi-list-check"></i> Data Karyawan produksisi Ready Meal</h3>
                <a href="{{ route('produksi.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>

            {{-- Search Form di kanan --}}
            <form method="GET" class="mb-3 d-flex justify-content-end">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Cari nama karyawan..." style="width: 250px;">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Search</button>
            </form>

            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th style="width: 20%;">Date</th>
                        <th>Nama Karyawan</th>
                        <th>Area</th>
                        <th style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produksi as $dep)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($dep->created_at)->format('d-m-Y H:i') }}</td>
                        <td>{{ $dep->nama_karyawan }}</td>
                        <td>{{ $dep->area }}</td>
                        <td class="text-center">
                            <a href="{{ route('produksi.edit', $dep->uuid) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('produksi.destroy', $dep->uuid) }}" method="POST" class="d-inline">
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
                    <td colspan="4" class="text-center">Belum ada data produksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end">
            {{ $produksi->links() }}
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
@endsection
