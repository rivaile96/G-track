@extends('layouts.app')

@section('title', 'Detail Driver: ' . $driver->name)

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Profil Lengkap Driver</h3>
            <div>
                {{-- [PERBAIKAN] Arahkan link ke route 'drivers.print' --}}
                <a href="{{ route('drivers.print', $driver->id) }}" class="btn btn-secondary" target="_blank"><i class="fa fa-print"></i> Cetak Dokumen</a>
                <a href="{{ route('drivers.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <div class="driver-profile">
                <div class="profile-photo">
                    <img src="{{ $driver->photo_path ? asset('storage/' . $driver->photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($driver->name) . '&background=0b0f19&color=08d3f8&size=256' }}" 
                         alt="{{ $driver->name }}">
                </div>
                <div class="profile-info">
                    <h2>{{ $driver->name }}</h2>
                    <span class="badge {{ $driver->status == 'available' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($driver->status) }}</span>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>No. Telepon</label>
                            <span>{{ $driver->phone_number }}</span>
                        </div>
                        <div class="info-item">
                            <label>No. KTP</label>
                            <span>{{ $driver->ktp_number }}</span>
                        </div>
                        <div class="info-item">
                            <label>Tipe SIM</label>
                            <span>{{ $driver->sim_type }}</span>
                        </div>
                        <div class="info-item">
                            <label>No. SIM</label>
                            <span>{{ $driver->sim_number }}</span>
                        </div>
                        <div class="info-item">
                            <label>SIM Kadaluarsa</label>
                            {{-- Menggunakan Carbon untuk memformat tanggal --}}
                            <span>{{ \Carbon\Carbon::parse($driver->sim_expiry_date)->format('d F Y') }}</span>
                        </div>
                         <div class="info-item info-item-full">
                            <label>Alamat</label>
                            <span>{{ $driver->address ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
