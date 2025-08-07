@extends('layouts.app')

@section('title', 'Edit Aset')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulir Edit Aset</h3>
        </div>
        <div class="card-body">
            {{-- Arahkan form ke route 'assets.update' dengan method PATCH --}}
            <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                @csrf
                @method('PATCH') {{-- Method spoofing untuk request UPDATE --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Aset</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $asset->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="unique_id" class="form-label">ID Unik Tracker/Device</label>
                    <input type="text" class="form-control" id="unique_id" name="unique_id" value="{{ old('unique_id', $asset->unique_id) }}" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Tipe Aset</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="mobil" {{ $asset->type == 'mobil' ? 'selected' : '' }}>Mobil</option>
                        <option value="device" {{ $asset->type == 'device' ? 'selected' : '' }}>Device</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status Aset</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="aktif" {{ $asset->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="standby" {{ $asset->status == 'standby' ? 'selected' : '' }}>Standby</option>
                        <option value="maintenance" {{ $asset->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Aset</button>
                <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection