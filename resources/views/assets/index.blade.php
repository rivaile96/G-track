@extends('layouts.app')

@section('title', 'Manajemen Aset')

@section('content')
    {{-- Menampilkan pesan sukses setelah create/delete --}}
    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert">
          {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Daftar Semua Aset</h3>
            <a href="{{ route('assets.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Aset Baru
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Aset</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>User</th>
                        <th style="width: 100px">Aksi</th> {{-- KOLOM BARU --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assets as $asset)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->type }}</td>
                            <td><span class="badge bg-success">{{ $asset->status }}</span></td>
                            <td>{{ $asset->assigned_to ?? '-' }}</td>
                            <td>
                                {{-- FORM UNTUK DELETE --}}
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus aset ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                {{-- Tombol Edit (nanti) --}}
                                <a href="#" class="btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data aset.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- Custom CSS untuk alert & button agar sesuai tema --}}
@push('styles')
<style>
    .alert-success {
        background-color: rgba(6, 182, 212, 0.2);
        color: var(--accent-cyan);
        border: 1px solid var(--accent-cyan);
    }
    .btn-primary { background-color: var(--accent-cyan); border-color: var(--accent-cyan); }
    .btn-danger { background-color: #ef4444; border-color: #ef4444; }
    .btn-info { background-color: #3b82f6; border-color: #3b82f6; }
    .badge.bg-success { background-color: #22c55e !important; }
</style>
@endpush