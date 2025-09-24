<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
        <div class="sidebar-brand-text mx-3">E-Ready Meal</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Master Data -->
    <div class="sidebar-heading">Master Data</div>
    @php
    $masterActive = request()->routeIs('departemen.*') || request()->routeIs('plant.*') || request()->routeIs('produk.*') || request()->routeIs('produksi.*');
    @endphp
    <li class="nav-item">
        <a class="nav-link {{ $masterActive ? '' : 'collapsed' }}" href="#"
        data-bs-toggle="collapse" data-bs-target="#collapseMasterData" aria-expanded="{{ $masterActive ? 'true' : 'false' }}" aria-controls="collapseMasterData">
        <i class="fas fa-database"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseMasterData" class="collapse {{ $masterActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
        <div class="bg-dark py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->routeIs('departemen.*') ? 'active' : '' }}" href="{{ route('departemen.index') }}">Departemen</a>
            <a class="collapse-item {{ request()->routeIs('plant.*') ? 'active' : '' }}" href="{{ route('plant.index') }}">Plant</a>
            <a class="collapse-item {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">List Produk</a>
            <a class="collapse-item {{ request()->routeIs('produksi.*') ? 'active' : '' }}" href="{{ route('produksi.index') }}">Karyawan Produksi</a>
        </div>
    </div>
</li>

<!-- Form QC -->
<div class="sidebar-heading">Form QC</div>
@php
$formActive = request()->routeIs('suhu.*') || request()->routeIs('sanitasi.*') || request()->routeIs('kebersihan_ruang.*') || request()->routeIs('gmp.*') || request()->routeIs('verifikasi_sanitasi.*');
@endphp
<li class="nav-item">
    <a class="nav-link {{ $formActive ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseFormQC" aria-expanded="{{ $formActive ? 'true' : 'false' }}" aria-controls="collapseFormQC">
    <i class="fas fa-clipboard-list"></i>
    <span>Suhu & Kebersihan</span>
</a>
<div id="collapseFormQC" class="collapse {{ $formActive ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <a class="collapse-item {{ request()->routeIs('suhu.*') ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a>
        <a class="collapse-item {{ request()->routeIs('sanitasi.*') ? 'active' : '' }}" href="{{ route('sanitasi.index') }}">Pemeriksaan Sanitasi</a>
        <a class="collapse-item {{ request()->routeIs('kebersihan_ruang.*') ? 'active' : '' }}" href="{{ route('kebersihan_ruang.index') }}">Kebersihan Ruangan</a>
        <a class="collapse-item {{ request()->routeIs('verifikasi_sanitasi.*') ? 'active' : '' }}" href="{{ route('verifikasi_sanitasi.index') }}">Verifikasi Sanitasi</a>
        <a class="collapse-item {{ request()->routeIs('gmp.*') ? 'active' : '' }}" href="{{ route('gmp.index') }}">GMP Karyawan</a>
    </div>
</div>
</li>

<!-- Cooking -->
@php
$formActiveCooking = request()->routeIs('premix.*') || request()->routeIs('institusi.*') || request()->routeIs('timbangan.*') || request()->routeIs('thermometer.*') || request()->routeIs('sortasi.*') || request()->routeIs('thawing.*') || request()->routeIs('yoshinoya.*') || request()->routeIs('steamer.*') || request()->routeIs('thumbling.*') || request()->routeIs('cooking.*');
@endphp
<li class="nav-item">
    <a class="nav-link {{ $formActiveCooking ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseCooking" aria-expanded="{{ $formActiveCooking ? 'true' : 'false' }}" aria-controls="collapseCooking">
    <i class="fas fa-utensils"></i>
    <span>Cooking</span>
</a>
<div id="collapseCooking" class="collapse {{ $formActiveCooking ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <a class="collapse-item {{ request()->routeIs('timbangan.*') ? 'active' : '' }}" href="{{ route('timbangan.index') }}">Peneraan Timbangan</a>
        <a class="collapse-item {{ request()->routeIs('thermometer.*') ? 'active' : '' }}" href="{{ route('thermometer.index') }}">Peneraan Thermometer</a>
        <a class="collapse-item {{ request()->routeIs('thawing.*') ? 'active' : '' }}" href="{{ route('thawing.index') }}">Pemeriksaan Proses Thawing</a>
        <a class="collapse-item {{ request()->routeIs('sortasi.*') ? 'active' : '' }}" href="{{ route('sortasi.index') }}">Sortasi Bahan Baku yang Tidak Sesuai</a>
        <a class="collapse-item {{ request()->routeIs('premix.*') ? 'active' : '' }}" href="{{ route('premix.index') }}">Verifikasi Premix</a>
        <a class="collapse-item {{ request()->routeIs('institusi.*') ? 'active' : '' }}" href="{{ route('institusi.index') }}">Verifikasi Produk Institusi</a>
        <a class="collapse-item {{ request()->routeIs('thumbling.*') ? 'active' : '' }}" href="{{ route('thumbling.index') }}">Pemeriksaan Proses Thumbling</a>
        <a class="collapse-item {{ request()->routeIs('steamer.*') ? 'active' : '' }}" href="{{ route('steamer.index') }}">Pemeriksaan Pemasakan dengan Steamer</a>
        <a class="collapse-item {{ request()->routeIs('cooking.*') ? 'active' : '' }}" href="{{ route('cooking.index') }}">Pemeriksaan Pemasakan Produk di Steam/Cooking Kettle</a>
        <a class="collapse-item {{ request()->routeIs('yoshinoya.*') ? 'active' : '' }}" href="{{ route('yoshinoya.index') }}">Parameter Produk Saus Yoshinoya</a>
    </div>
</div>
</li>

<!-- Packing -->
@php
$formActivePacking = request()->routeIs('kontaminasi.*') || request()->routeIs('xray.*') || request()->routeIs('metal.*') || request()->routeIs('tahapan.*') || request()->routeIs('gramasi.*') || request()->routeIs('iqf.*') || request()->routeIs('pengemasan.*') || request()->routeIs('mesin.*') || request()->routeIs('disposisi.*') || request()->routeIs('repack.*') || request()->routeIs('reject.*');
@endphp
<li class="nav-item">
    <a class="nav-link {{ $formActivePacking ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapsePacking" aria-expanded="{{ $formActivePacking ? 'true' : 'false' }}" aria-controls="collapsePacking">
    <i class="fas fa-box"></i>
    <span>Packing</span>
</a>
<div id="collapsePacking" class="collapse {{ $formActivePacking ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
        <a class="collapse-item {{ request()->routeIs('mesin.*') ? 'active' : '' }}" href="{{ route('mesin.index') }}">Verifikasi Mesin</a>
        <a class="collapse-item {{ request()->routeIs('tahapan.*') ? 'active' : '' }}" href="{{ route('tahapan.index') }}">Pengecekan Suhu Produk Setiap Tahapan Proses</a>
        <a class="collapse-item {{ request()->routeIs('gramasi.*') ? 'active' : '' }}" href="{{ route('gramasi.index') }}">Verifikasi Gramasi Topping</a>
        <a class="collapse-item {{ request()->routeIs('iqf.*') ? 'active' : '' }}" href="{{ route('iqf.index') }}">Pemeriksaan Suhu Produk Setelah IQF</a>
        <a class="collapse-item {{ request()->routeIs('pengemasan.*') ? 'active' : '' }}" href="{{ route('pengemasan.index') }}">Verifikasi Pengemasan</a>
        <a class="collapse-item {{ request()->routeIs('xray.*') ? 'active' : '' }}" href="{{ route('xray.index') }}">Pemeriksaan X Ray</a>
        <a class="collapse-item {{ request()->routeIs('metal.*') ? 'active' : '' }}" href="{{ route('metal.index') }}">Pemeriksaan Metal Detector</a>
        <a class="collapse-item {{ request()->routeIs('reject.*') ? 'active' : '' }}" href="{{ route('reject.index') }}">Monitoring False Rejection</a>
        <a class="collapse-item {{ request()->routeIs('kontaminasi.*') ? 'active' : '' }}" href="{{ route('kontaminasi.index') }}">Kontaminasi Benda Asing</a>
        <a class="collapse-item {{ request()->routeIs('disposisi.*') ? 'active' : '' }}" href="{{ route('disposisi.index') }}">Pemeriksaan Disposisi Produk Tidak Sesuai</a>
        <a class="collapse-item {{ request()->routeIs('repack.*') ? 'active' : '' }}" href="{{ route('repack.index') }}">Monitoring Proses Repack</a>

    </div>
</div>
</li>

<!-- Warehouse -->
@php
$formActiveWarehouse = request()->routeIs('noodle.*') || request()->routeIs('rice.*') || request()->routeIs('pemusnahan.*') || request()->routeIs('retur.*') || request()->routeIs('retain.*') || request()->routeIs('sample_bulanan.*') || request()->routeIs('cold_storage.*') || request()->routeIs('sample_retain.*') || request()->routeIs('submission.*') ;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $formActiveWarehouse ? '' : 'collapsed' }}" href="#"
    data-bs-toggle="collapse" data-bs-target="#collapseWarehouse" aria-expanded="{{ $formActiveWarehouse ? 'true' : 'false' }}" aria-controls="collapseWarehouse">
    <i class="fas fa-box"></i>
    <span>Warehouse</span>
</a>
<div id="collapseWarehouse" class="collapse {{ $formActiveWarehouse ? 'show' : '' }}" data-bs-parent="#accordionSidebar">
    <div class="bg-dark py-2 collapse-inner rounded">
      <a class="collapse-item {{ request()->routeIs('rice.*') ? 'active' : '' }}" href="{{ route('rice.index') }}">Pemeriksaan Pemasakan Rice Cooker</a>
      <a class="collapse-item {{ request()->routeIs('noodle.*') ? 'active' : '' }}" href="{{ route('noodle.index') }}">Pemeriksaan Pemasakan Noodle</a>
      <a class="collapse-item {{ request()->routeIs('cold_storage.*') ? 'active' : '' }}" href="{{ route('cold_storage.index') }}">Pemantauan Suhu Produk di Cold Storage</a>
      <a class="collapse-item {{ request()->routeIs('submission.*') ? 'active' : '' }}" href="{{ route('submission.index') }}">Laboratory Sample Submission Report</a>
      <a class="collapse-item {{ request()->routeIs('retain.*') ? 'active' : '' }}" href="{{ route('retain.index') }}">Retained Sample Report</a>
      <a class="collapse-item {{ request()->routeIs('sample_bulanan.*') ? 'active' : '' }}" href="{{ route('sample_bulanan.index') }}">Sample Bulanan RND</a>
      <a class="collapse-item {{ request()->routeIs('sample_retain.*') ? 'active' : '' }}" href="{{ route('sample_retain.index') }}">Pemeriksaan Sampel Retain</a>
      <a class="collapse-item {{ request()->routeIs('pemusnahan.*') ? 'active' : '' }}" href="{{ route('pemusnahan.index') }}">Pemusnahan Barang / Produk</a>
      <a class="collapse-item {{ request()->routeIs('retur.*') ? 'active' : '' }}" href="{{ route('retur.index') }}">Pemeriksaan Produk Retur</a>
  </div>
</div>
</li>

<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggle -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>

<!-- Sidebar CSS -->
<style>
    #accordionSidebar {
        width: 220px;
        transition: width 0.3s;
        min-height: 100vh;
        overflow-x: hidden;
        background: #4e73df;
    }

    #accordionSidebar.minimized {
        width: 150px;
    }

    #accordionSidebar .nav-link i {
        min-width: 25px;
        text-align: center;
    }

    #accordionSidebar .nav-link span {
        transition: all 0.3s;
    }

    #accordionSidebar .collapse-inner a {
        display: block;
        white-space: normal;
        overflow-wrap: break-word;
        color: #fff !important;
        padding: 0.5rem 1rem;
        transition: background 0.2s;
    }

    #accordionSidebar .collapse-inner a:hover {
        background-color: rgba(255,255,255,0.1);
    }

    .collapse-item.active {
        background-color: rgba(255,255,255,0.2);
        font-weight: bold;
    }

/* Dropdown saat sidebar minimized */
#accordionSidebar.minimized .collapse-inner {
    position: absolute;
    left: 150px;
    top: 0;
    background: #4e73df;
    min-width: 200px;
    z-index: 9999;
    display: none;
}

#accordionSidebar.minimized .collapse.show .collapse-inner {
    display: block;
}

/* Sidebar toggle button */
#sidebarToggle {
    width: 35px;
    height: 35px;
    cursor: pointer;
    background-color: #fff;
    transition: transform 0.3s;
}
</style>

<!-- Sidebar JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Toggle sidebar
    const sidebar = document.getElementById('accordionSidebar');
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        sidebar.classList.toggle('minimized');
    });

// Collapse dropdown fix saat minimized
    document.querySelectorAll('#accordionSidebar .nav-link[data-bs-toggle="collapse"]').forEach(function(link){
        link.addEventListener('click', function(e){
            if(sidebar.classList.contains('minimized')){
                const targetId = link.getAttribute('data-bs-target');
                const collapseEl = document.querySelector(targetId);
                collapseEl.classList.toggle('show');
            }
        });
    });
</script>
