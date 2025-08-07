<?php

namespace App\Http\Controllers\Api;

use App\Events\AssetLocationUpdated; // <-- Panggil Event
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class TrackingController extends Controller
{
    /**
     * Menerima dan memproses data lokasi yang masuk.
     */
    public function track(Request $request)
    {
        // 1. Validasi data
        $validatedData = $request->validate([
            'unique_id' => 'required|string|exists:assets,unique_id',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // 2. Cari aset
        $asset = Asset::where('unique_id', $validatedData['unique_id'])->first();

        // 3. Update lokasi
        $asset->latitude = $validatedData['latitude'];
        $asset->longitude = $validatedData['longitude'];
        $asset->save();

        // 4. [PERBAIKAN] "Teriakkan" event ke Reverb setelah data disimpan!
        AssetLocationUpdated::dispatch($asset);

        // 5. Kirim response sukses
        return response()->json([
            'status' => 'success',
            'message' => 'Location updated and event broadcasted.',
        ]);
    }
}
