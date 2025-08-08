<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LacakAset Dashboard')</title>
    
    {{-- Memanggil Font Poppins dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Memanggil Font Awesome untuk Ikon via CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- Menambahkan Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    {{-- Memanggil CSS & JS kita sendiri via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('styles')
</head>
<body>
    <div class="dashboard-layout">
        
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3 class="sidebar-title">
                    <i class="fa-solid fa-satellite-dish"></i>
                    <span>LacakAset</span>
                </h3>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt fa-fw"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="nav-item has-submenu">
                    <a href="#" class="nav-link {{ request()->is('assets*') ? 'active' : '' }}">
                        <i class="fa fa-boxes-stacked fa-fw"></i>
                        <span>Manajemen Aset</span>
                        <i class="fa fa-chevron-down submenu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('assets.index') }}">Daftar Aset</a></li>
                        {{-- [PERBAIKAN] Link "Tambah Aset Baru" di sini dihapus --}}
                    </ul>
                </div>

                <a href="{{ route('drivers.index') }}" class="nav-link {{ request()->is('drivers*') ? 'active' : '' }}">
                    <i class="fa fa-id-card fa-fw"></i>
                    <span>Manajemen Driver</span>
                </a>
                
                <a href="#" class="nav-link">
                    <i class="fa fa-map-location-dot fa-fw"></i>
                    <span>Peta Real-time</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <button class="sidebar-toggle" id="sidebar-toggle">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <p>Selamat datang kembali, T1Rx!</p>
            </header>
            
            <div class="content-body">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Menambahkan Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    @stack('scripts')
</body>
</html>
