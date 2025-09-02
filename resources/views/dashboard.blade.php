<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app') {{-- kalau kamu pakai layout utama --}}

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    <div class="card">
        <div class="card-body">
            <p>Selamat datang di aplikasi monitoring suhu.</p>
            <a href="{{ route('suhu.index') }}" class="btn btn-primary">Lihat Data Suhu</a>
        </div>
    </div>
</div>
@endsection
