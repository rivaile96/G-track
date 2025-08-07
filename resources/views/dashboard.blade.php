@extends('layouts.app')

@section('title', 'Dashboard Peta')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Peta Sebaran Aset</h3>
        </div>
        <div class="card-body p-0">
            {{-- Ini adalah "kanvas" untuk peta kita. Kita beri style agar punya ketinggian. --}}
            <div id="map"></div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Peta pada div dengan id="map"
    var map = L.map('map').setView([-6.200000, 106.816666], 11);

    // Menambahkan Tile Layer (gambar dasar peta) dari OpenStreetMap
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors &copy; CARTO'
    }).addTo(map);

    // Ambil data aset yang dikirim dari controller
    const assets = @json($assets);

    // Lakukan perulangan untuk setiap aset dan buat pin di peta
    assets.forEach(asset => {
        // Buat marker di lokasi aset
        let marker = L.marker([asset.latitude, asset.longitude]).addTo(map);

        // Tambahkan popup yang berisi nama aset
        marker.bindPopup(`<b>${asset.name}</b><br>Status: ${asset.status}`);
    });

</script>
@endpush