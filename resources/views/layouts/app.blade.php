<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LacakAset Dashboard')</title>
    
    {{-- Memanggil CSS & JS kita sendiri via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Untuk ikon, kita pakai Font Awesome via CDN karena mudah & stabil --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- Slot untuk CSS tambahan per halaman jika dibutuhkan --}}
    @yield('styles')
</head>
<body>
    <div class="dashboard-layout">
        {{-- ========== SIDEBAR (KOLOM KIRI) ========== --}}
        {{-- ========== SIDEBAR (KOLOM KIRI) ========== --}}
<aside class="sidebar">
    <div class="sidebar-header">
        <h3 class="sidebar-title">
            <i class="fa-solid fa-satellite-dish"></i>
            <span>LacakAset</span>
        </h3>
        {{-- Tombol untuk hide/show sidebar --}}
        <button class="sidebar-toggle" id="sidebar-toggle">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa fa-tachometer-alt fa-fw"></i>
            <span>Dashboard</span>
        </a>
        
        {{-- STRUKTUR DROPDOWN BARU --}}
        <div class="nav-item has-submenu">
            <a href="#" class="nav-link {{ request()->routeIs('assets.index') ? 'active' : '' }}">
                <i class="fa fa-boxes-stacked fa-fw"></i>
                <span>Manajemen Aset</span>
                <i class="fa fa-chevron-down submenu-arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('assets.index') }}">Daftar Aset</a></li>
                <li><a href="{{ route('assets.create') }}">Tambah Aset Baru</a></li>
            </ul>
        </div>
        
        <a href="#" class="nav-link">
            <i class="fa fa-map-location-dot fa-fw"></i>
            <span>Peta Real-time</span>
        </a>
    </nav>
</aside>
                {{-- Link ke Dashboard --}}
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt fa-fw"></i> &nbsp; Dashboard
                </a>
                
                {{-- Link ke Manajemen Aset --}}
                <a href="{{ route('assets.index') }}" class="nav-link {{ request()->routeIs('assets.index') ? 'active' : '' }}">
                    <i class="fa fa-boxes-stacked fa-fw"></i> &nbsp; Manajemen Aset
                </a>

                {{-- Contoh menu lain nanti --}}
                <a href="#" class="nav-link">
                    <i class="fa fa-map-location-dot fa-fw"></i> &nbsp; Peta Real-time
                </a>
            </nav>
        </aside>

        {{-- ========== KONTEN UTAMA (KOLOM KANAN) ========== --}}
        <main class="main-content">
            <header class="main-header">
                <p>Selamat datang kembali, T1Rx!</p>
            </header>
            
            <div class="content-body">
                {{-- Di sinilah konten dari dashboard.blade.php atau assets/index.blade.php akan ditampilkan --}}
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Slot untuk JS tambahan per halaman jika dibutuhkan --}}
    @yield('scripts')
</body>
</html>