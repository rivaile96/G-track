@extends('layouts.app')

@section('title', 'Tambah Driver Baru')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulir Tambah Driver Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Kolom Kiri: Data Diri --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Contoh: 08123456789" required>
                        </div>
                        <div class="mb-3">
                            <label for="ktp_number" class="form-label">No. KTP</label>
                            <input type="text" class="form-control" id="ktp_number" name="ktp_number" placeholder="16 digit nomor KTP" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="4" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Data SIM & Foto --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sim_type" class="form-label">Tipe SIM</label>
                            <input type="text" class="form-control" id="sim_type" name="sim_type" placeholder="Contoh: A, B1 Umum" required>
                        </div>
                        <div class="mb-3">
                            <label for="sim_number" class="form-label">No. SIM</label>
                            <input type="text" class="form-control" id="sim_number" name="sim_number" placeholder="12 digit nomor SIM" required>
                        </div>
                        <div class="mb-3">
                            <label for="sim_expiry_date" class="form-label">Tanggal Kadaluarsa SIM</label>
                            <input type="date" class="form-control" id="sim_expiry_date" name="sim_expiry_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto Driver (Opsional)</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Driver</button>
                    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
