@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Alert sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📋 Data Departemen</h3>
        <a href="{{ route('departemen.create') }}" class="btn btn-success">+ Tambah</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" style="width: 25%;">Tanggal Dibuat</th>
                        <th scope="col">Nama Departemen</th>
                        <th scope="col" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departemens as $dep)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($dep->created_at)->format('d-m-Y H:i') }}</td>
                        <td>{{ $dep->nama }}</td>
                        <td>
                            <a href="{{ route('departemen.edit', $dep->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                            <form action="{{ route('departemen.destroy', $dep->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data departemen.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection