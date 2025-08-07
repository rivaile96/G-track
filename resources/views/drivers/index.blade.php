@extends('layouts.app')

@section('title', 'Manajemen Driver')

@section('content')
    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert">
          {{ session('success') }}
        </div>
    @endif

    <div class="card-header mb-4">
        <h3 class="card-title">Galeri Driver</h3>
        <button id="add-driver-btn" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Driver Baru
        </button>
    </div>

    {{-- Ini adalah bagian yang menampilkan galeri kartu --}}
    <div class="driver-grid">
        @forelse ($drivers as $driver)
            <div class="driver-card">
                <div class="card-header-line"></div>
                <div class="card-content">
                    <div class="driver-photo-lg">
                        <img src="{{ $driver->photo_path ? asset('storage/' . $driver->photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($driver->name) . '&background=0b0f19&color=08d3f8&size=128' }}" 
                             alt="{{ $driver->name }}">
                    </div>
                    <div class="driver-details">
                        <div class="detail-item">
                            <label>Nama</label>
                            <span>{{ $driver->name }}</span>
                        </div>
                        <div class="detail-item">
                            <label>Status</label>
                            <span class="status-{{ $driver->status }}">{{ $driver->status }}</span>
                        </div>
                        <div class="detail-item">
                            <label>No. SIM</label>
                            <span>{{ $driver->sim_number }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-actions">
                    <a href="{{ route('drivers.show', $driver->id) }}" class="action-btn detail-btn">Detail</a>
                    <a href="{{ route('drivers.edit', $driver->id) }}" class="action-btn edit-btn">Edit</a>
                    <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete-btn" onclick="return confirm('Yakin mau hapus driver ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            {{-- Ini akan muncul jika tidak ada data driver sama sekali --}}
            <div class="card">
                <p class="text-center py-4">Belum ada data driver. Silakan klik tombol "Tambah Driver Baru".</p>
            </div>
        @endforelse
    </div>

    {{-- Struktur HTML untuk Modal Tambah Driver --}}
    <div id="driver-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h3 class="modal-title">Create a new driver</h3>
                    <p class="modal-subtitle">Isi semua data yang dibutuhkan untuk mendaftarkan driver baru.</p>
                </div>
                <button id="close-modal-btn" class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3"><label for="name" class="form-label">Nama Lengkap</label><input type="text" class="form-control" id="name" name="name" required></div>
                            <div class="mb-3"><label for="phone_number" class="form-label">No. Telepon</label><input type="text" class="form-control" id="phone_number" name="phone_number" required></div>
                            <div class="mb-3"><label for="ktp_number" class="form-label">No. KTP</label><input type="text" class="form-control" id="ktp_number" name="ktp_number" required></div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3"><label for="sim_type" class="form-label">Tipe SIM</label><input type="text" class="form-control" id="sim_type" name="sim_type" required></div>
                            <div class="mb-3"><label for="sim_number" class="form-label">No. SIM</label><input type="text" class="form-control" id="sim_number" name="sim_number" required></div>
                            <div class="mb-3"><label for="sim_expiry_date" class="form-label">Tanggal Kadaluarsa SIM</label><input type="date" class="form-control" id="sim_expiry_date" name="sim_expiry_date" required></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cancel-modal-btn" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">Create Driver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
