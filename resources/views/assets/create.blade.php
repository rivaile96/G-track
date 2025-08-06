@extends('layouts.app')

@section('title', 'Tambah Aset Baru')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulir Tambah Aset Baru</h3>
        </div>
        <div class="card-body">
            {{-- Arahkan form ke route 'assets.store' dengan method POST --}}
            <form action="{{ route('assets.store') }}" method="POST">
                @csrf  {{-- Token keamanan Laravel, wajib ada --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Aset</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: Avanza B 1234 ABC" required>
                </div>

                <div class="mb-3">
                    <label for="unique_id" class="form-label">ID Unik Tracker/Device</label>
                    <input type="text" class="form-control" id="unique_id" name="unique_id" placeholder="Contoh: CAR-001" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Tipe Aset</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="mobil">Mobil</option>
                        <option value="device">Device</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Aset</button>
                <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection