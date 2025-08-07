@extends('layouts.app')

@section('title', 'Manajemen Aset')

@section('content')
    {{-- Bagian ini untuk menampilkan notifikasi sukses setelah menambah, mengedit, atau menghapus data --}}
    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert">
          {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Daftar Semua Aset</h3>
            {{-- Tombol ini mengarah ke halaman form tambah aset baru --}}
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
                        <th style="width: 100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop untuk setiap data aset yang dikirim dari controller --}}
                    @forelse ($assets as $asset)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->type }}</td>
                            <td>
                                {{-- Memberi warna berbeda untuk setiap status --}}
                                @if($asset->status == 'aktif')
                                    <span class="badge bg-success">{{ $asset->status }}</span>
                                @elseif($asset->status == 'maintenance')
                                    <span class="badge bg-warning">{{ $asset->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $asset->status }}</span>
                                @endif
                            </td>
                            <td>{{ $asset->assigned_to ?? '-' }}</td>
                            <td>
                                {{-- Tombol Edit mengarah ke halaman form edit --}}
                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                
                                {{-- Tombol Delete berada di dalam form untuk keamanan --}}
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus aset ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        {{-- Tampilan jika tidak ada data sama sekali --}}
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data aset. Silakan tambah aset baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- Menambahkan sedikit style custom agar tombol dan notifikasi lebih menyatu dengan tema Sci-Fi kita --}}
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
    .btn-secondary { background-color: #6b7280; border-color: #6b7280; }
    .badge.bg-success { background-color: #22c55e !important; }
    .badge.bg-warning { background-color: #f59e0b !important; color: #111827 !important; }
    .badge.bg-secondary { background-color: #6b7280 !important; }
</style>
@endpush