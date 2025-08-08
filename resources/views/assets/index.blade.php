@extends('layouts.app')

@section('title', 'Manajemen Aset')

@section('content')
    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert">
          {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Semua Aset</h3>
            <a href="{{ route('assets.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Aset Baru
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Aset</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Driver Bertugas</th> {{-- [PERUBAHAN] Judul kolom --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assets as $asset)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->type }}</td>
                            <td>
                                @if($asset->status == 'aktif')
                                    <span class="badge bg-success">{{ $asset->status }}</span>
                                @elseif($asset->status == 'maintenance')
                                    <span class="badge bg-warning">{{ $asset->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $asset->status }}</span>
                                @endif
                            </td>
                            {{-- [PERUBAHAN] Menampilkan nama driver dari relasi jika ada --}}
                            <td>{{ $asset->driver->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus aset ini?')"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data aset.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
