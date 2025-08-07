<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua aset yang punya latitude dan longitude
        $assets = Asset::whereNotNull('latitude')->whereNotNull('longitude')->get();

        // Kirim data aset ke view dashboard
        return view('dashboard', ['assets' => $assets]);
    }
}