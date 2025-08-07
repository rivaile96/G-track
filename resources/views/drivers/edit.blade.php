@extends('layouts.app')

@section('title', 'Edit Driver: ' . $driver->name)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulir Edit Driver</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    {{-- Kolom Kiri: Data Diri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $driver->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $driver->phone_number) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ktp_number" class="form-label">No. KTP</label>
                            <input type="text" class="form-control" id="ktp_number" name="ktp_number" value="{{ old('ktp_number', $driver->ktp_number) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="4">{{ old('address', $driver->address) }}</textarea>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Data SIM & Foto --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sim_type" class="form-label">Tipe SIM</label>
                            <input type="text" class="form-control" id="sim_type" name="sim_type" value="{{ old('sim_type', $driver->sim_type) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="sim_number" class="form-label">No. SIM</label>
                            <input type="text" class="form-control" id="sim_number" name="sim_number" value="{{ old('sim_number', $driver->sim_number) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="sim_expiry_date" class="form-label">Tanggal Kadaluarsa SIM</label>
                            <input type="date" class="form-control" id="sim_expiry_date" name="sim_expiry_date" value="{{ $driver->sim_expiry_date }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            @if($driver->photo_path)
                                <div class="mt-2">
                                    <small class="form-text text-secondary">Foto saat ini:</small>
                                    <img src="{{ asset('storage/' . $driver->photo_path) }}" alt="Foto {{ $driver->name }}" class="current-photo">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Driver</button>
                    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
