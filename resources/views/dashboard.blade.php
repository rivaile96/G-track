@extends('layouts.app')

@section('title', 'Dashboard Peta')

@section('content')
    {{-- [BARU] Bagian untuk 4 Kartu Statistik (KPI) --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="card-icon"><i class="fa-solid fa-truck"></i></div>
            <div class="card-details">
                <span class="card-value">{{ $totalAssets }}</span>
                <span class="card-label">Total Aset Terdaftar</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="card-icon"><i class="fa-solid fa-satellite-dish"></i></div>
            <div class="card-details">
                <span class="card-value">{{ $activeAssets }}</span>
                <span class="card-label">Aset Sedang Aktif</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="card-icon"><i class="fa-solid fa-id-card"></i></div>
            <div class="card-details">
                <span class="card-value">{{ $totalDrivers }}</span>
                <span class="card-label">Total Driver Terdaftar</span>
            </div>
        </div>
        <div class="kpi-card">
            <div class="card-icon"><i class="fa-solid fa-traffic-light"></i></div>
            <div class="card-details">
                <span class="card-value">{{ $driversOnDuty }}</span>
                <span class="card-label">Driver Sedang Bertugas</span>
            </div>
        </div>
    </div>

    {{-- [BARU] Layout 2 Kolom untuk Peta dan Driver Feed --}}
    <div class="dashboard-main-panel">
        {{-- Kolom Kiri: Peta --}}
        <div class="map-container card">
            <div id="map"></div>
        </div>

        {{-- Kolom Kanan: Active Driver Feed --}}
        <div class="driver-feed-container card">
            <div class="card-header">
                <h3 class="card-title">Active Driver Feed</h3>
            </div>
            <div class="driver-feed-body">
                @forelse ($assetsForMap as $asset)
                    @if($asset->driver)
                        <div class="driver-feed-item" data-lat="{{ $asset->latitude }}" data-lng="{{ $asset->longitude }}">
                            <img src="{{ $asset->driver->photo_path ? asset('storage/' . $asset->driver->photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($asset->driver->name) . '&background=1e293b&color=e2e8f0' }}" 
                                 alt="{{ $asset->driver->name }}" class="driver-photo">
                            <div class="feed-item-info">
                                <strong>{{ $asset->driver->name }}</strong>
                                <small>Membawa: {{ $asset->name }}</small>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-center text-secondary p-4">Tidak ada driver yang sedang bertugas.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Peta
    var map = L.map('map').setView([-6.200000, 106.816666], 11);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
    }).addTo(map);

    // Ambil data aset dari controller
    const assets = @json($assetsForMap);
    let markers = {};

    // Loop untuk menaruh pin awal di peta
    assets.forEach(asset => {
        if (asset.latitude && asset.longitude) {
            let marker = L.marker([asset.latitude, asset.longitude]).addTo(map);
            // Tampilkan nama driver di popup jika ada
            marker.bindPopup(`<b>${asset.name}</b><br>Driver: ${asset.driver ? asset.driver.name : 'N/A'}`);
            markers[asset.unique_id] = marker;
        }
    });

    // [BARU] Logika interaktif untuk Driver Feed
    document.querySelectorAll('.driver-feed-item').forEach(item => {
        item.addEventListener('click', function() {
            const lat = this.dataset.lat;
            const lng = this.dataset.lng;
            map.flyTo([lat, lng], 15); // Geser peta dengan animasi ke lokasi driver
        });
    });

    // Bagian Real-time (tetap sama)
    window.Echo.channel('map-updates')
        .listen('AssetLocationUpdated', (e) => {
            console.log('Update diterima!', e);
            // ... (logika update pin real-time)
        });
</script>
@endpush
