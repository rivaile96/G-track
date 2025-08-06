@extends('layouts.app')

{{-- Set Judul Halaman di tab browser --}}
@section('title', 'Dashboard | LacakAset V2')

{{-- Isi Konten Halaman --}}
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-map-marked-alt"></i>
                    Peta Pelacakan Aset
                </h3>
            </div>
            <div class="card-body">
                <h4>Selamat Datang di Dashboard!</h4>
                <p class="card-text">
                    Ini adalah area konten utama. Selanjutnya, kita akan mengganti area ini dengan Peta Interaktif menggunakan Leaflet.js untuk menampilkan semua aset kita. Siap, brody?
                </p>
            </div>
        </div>
    </div>
</div>
@endsection