@extends('layouts.app')

@section('title', 'Edit Aset: ' . $asset->name)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulir Edit Aset</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Aset</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $asset->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="unique_id" class="form-label">ID Unik Tracker/Device</label>
                            <input type="text" class="form-control" id="unique_id" name="unique_id" value="{{ old('unique_id', $asset->unique_id) }}" required>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Tipe Aset</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="mobil" {{ $asset->type == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                <option value="device" {{ $asset->type == 'device' ? 'selected' : '' }}>Device</option>
                            </select>
                        </div>
                        
                        {{-- [PERUBAHAN UTAMA] Dropdown untuk menugaskan driver --}}
                        <div class="mb-3">
                            <label for="driver_id" class="form-label">Tugaskan Driver</label>
                            <select class="form-select" id="driver_id" name="driver_id">
                                <option value="">-- Lepas Tugas / Tidak Ditugaskan --</option>
                                
                                {{-- Jika aset ini sudah punya driver, tampilkan namanya di daftar --}}
                                @if($asset->driver)
                                    <option value="{{ $asset->driver->id }}" selected>{{ $asset->driver->name }} (Sedang Bertugas)</option>
                                @endif

                                {{-- Tampilkan semua driver lain yang statusnya 'available' --}}
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Aset</button>
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
