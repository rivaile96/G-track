<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Driver; // <-- [PENTING] Panggil model Driver
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menyiapkan semua data dan menampilkan halaman dashboard utama.
     */
    public function index()
    {
        // 1. Menghitung data untuk Kartu Statistik (KPI)
        $totalAssets = Asset::count();
        $activeAssets = Asset::where('status', 'aktif')->count();
        $totalDrivers = Driver::count();
        $driversOnDuty = Driver::where('status', 'on_duty')->count();

        // 2. Mengambil data aset yang aktif untuk ditampilkan di peta dan "Active Driver Feed"
        //    'with('driver')' akan mengambil data driver terkait agar lebih efisien (Eager Loading)
        $assetsForMap = Asset::with('driver')
                            ->where('status', 'aktif')
                            ->whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->get();

        // 3. Mengirim semua data yang sudah disiapkan ke view 'dashboard'
        return view('dashboard', [
            'totalAssets' => $totalAssets,
            'activeAssets' => $activeAssets,
            'totalDrivers' => $totalDrivers,
            'driversOnDuty' => $driversOnDuty,
            'assetsForMap' => $assetsForMap,
        ]);
    }
}
