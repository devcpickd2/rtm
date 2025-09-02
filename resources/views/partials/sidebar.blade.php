<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-Ready Meal</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    @if (Route::has('dashboard'))
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @endif 

    <hr class="sidebar-divider">

    <!-- Master Data Collapse -->
    <div class="sidebar-heading">
        Master Data
    </div>

    @php
    $masterActive = request()->routeIs('departemen.*') || request()->routeIs('plant.*') || request()->routeIs('produk.*') || request()->routeIs('produksi.*') ;
    @endphp
    <li class="nav-item">
        <a class="nav-link {{ $masterActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMasterData" aria-expanded="{{ $masterActive ? 'true' : 'false' }}" aria-controls="collapseMasterData">
            <i class="fas fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse {{ $masterActive ? 'show' : '' }}">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white {{ request()->routeIs('departemen.*') ? 'active' : '' }}" href="{{ route('departemen.index') }}">Departemen</a>
                <a class="collapse-item text-white {{ request()->routeIs('plant.*') ? 'active' : '' }}" href="{{ route('plant.index') }}">Plant</a>
                <a class="collapse-item text-white {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">List Produk</a>
                <a class="collapse-item text-white {{ request()->routeIs('produksi.*') ? 'active' : '' }}" href="{{ route('produksi.index') }}">Karyawan Produksi</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Form Suhu & Kebersihan Collapse -->
    <div class="sidebar-heading">
        Form QC
    </div>

    @php
    $formActive = request()->routeIs('suhu.*') || request()->routeIs('sanitasi.*') || request()->routeIs('kebersihan_ruang.*') || request()->routeIs('gmp.*') ;
    @endphp
    <li class="nav-item">
        <a class="nav-link {{ $formActive ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFormSuhu" aria-expanded="{{ $formActive ? 'true' : 'false' }}" aria-controls="collapseFormSuhu">
            <i class="fas fa-clipboard-list"></i>
            <span>Suhu & Kebersihan</span>
        </a>
        <div id="collapseFormSuhu" class="collapse {{ $formActive ? 'show' : '' }}">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white {{ request()->routeIs('suhu.*') ? 'active' : '' }}" href="{{ route('suhu.index') }}">Pemeriksaan Suhu Ruang</a>
                <a class="collapse-item text-white {{ request()->routeIs('sanitasi.*') ? 'active' : '' }}" href="{{ route('sanitasi.index') }}">Pemeriksaan Sanitasi</a>
                <a class="collapse-item text-white {{ request()->routeIs('kebersihan_ruang.*') ? 'active' : '' }}" href="{{ route('kebersihan_ruang.index') }}">Kebersihan Ruangan</a>
                <a class="collapse-item text-white {{ request()->routeIs('gmp.*') ? 'active' : '' }}" href="{{ route('gmp.index') }}">GMP Karyawan</a>
            </div>
        </div>
    </li>


    @php
    $formActiveCooking = request()->routeIs('premix.*') || request()->routeIs('institusi.*') || request()->routeIs('timbangan.*') || request()->routeIs('thermometer.*') || request()->routeIs('sortasi.*') || request()->routeIs('thawing.*') || request()->routeIs('yoshinoya.*') ;
    @endphp
    <li class="nav-item">
        <a class="nav-link {{ $formActiveCooking ? '' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFormCooking" aria-expanded="{{ $formActiveCooking ? 'true' : 'false' }}" aria-controls="collapseFormCooking">
            <i class="fas fa-clipboard-list"></i>
            <span>Cooking</span>
        </a>
        <div id="collapseFormCooking" class="collapse {{ $formActiveCooking ? 'show' : '' }}">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white {{ request()->routeIs('premix.*') ? 'active' : '' }}" href="{{ route('premix.index') }}">Verifikasi Premix</a>
                <a class="collapse-item text-white {{ request()->routeIs('institusi.*') ? 'active' : '' }}" href="{{ route('institusi.index') }}">Verifikasi Produk Institusi</a>
                <a class="collapse-item text-white {{ request()->routeIs('timbangan.*') ? 'active' : '' }}" href="{{ route('timbangan.index') }}">Peneraan Timbangan</a>
                <a class="collapse-item text-white {{ request()->routeIs('thermometer.*') ? 'active' : '' }}" href="{{ route('thermometer.index') }}">Peneraan Thermometer</a>
                <a class="collapse-item text-white {{ request()->routeIs('sortasi.*') ? 'active' : '' }}" href="{{ route('sortasi.index') }}">Sortasi Bahan Baku yang Tidak Sesuai</a>
                <a class="collapse-item text-white {{ request()->routeIs('thawing.*') ? 'active' : '' }}" href="{{ route('thawing.index') }}">Pemeriksaan Proses Thawing</a>
                <a class="collapse-item text-white {{ request()->routeIs('yoshinoya.*') ? 'active' : '' }}" href="{{ route('yoshinoya.index') }}">Parameter Produk Saus Yoshinoya</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- Custom CSS -->
<style>
    /* Lebar sidebar */
    #accordionSidebar {
        width: 220px;
        min-width: 220px;
        max-width: 220px;
        overflow-x: hidden; /* sembunyikan overflow horizontal */
        transition: width 0.3s;
    }

    /* Sidebar collapse menjadi icon-only */
    #accordionSidebar.toggled {
        width: 80px;
    }
    #accordionSidebar.toggled .nav-link span {
        display: none;
    }
    #accordionSidebar.toggled .sidebar-brand-text {
        display: none;
    }

    /* Jarak antar item rapat */
    #accordionSidebar .nav-item {
        margin: 0;
    }

    #accordionSidebar .nav-link {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #accordionSidebar .sidebar-heading {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }

    /* Collapse inner */
    #accordionSidebar .collapse-inner {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    #accordionSidebar .collapse-inner a {
        padding-left: 1rem;
        padding-right: 1rem;
        display: block;
        white-space: normal;
        overflow-wrap: break-word;
    }

    /* Highlight active collapse item */
    .collapse-item.active {
        background-color: rgba(255, 255, 255, 0.1);
        font-weight: bold;
    }
</style>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar toggle JS -->
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('accordionSidebar').classList.toggle('toggled');
    });
</script>
