<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Driver; // <-- [PENTING] Panggil model Driver
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Menampilkan daftar semua aset.
     */
    public function index()
    {
        // 'with('driver')' akan mengambil data driver terkait dalam satu query (Eager Loading)
        $assets = Asset::with('driver')->latest()->get();
        return view('assets.index', ['assets' => $assets]);
    }

    /**
     * Menampilkan form untuk membuat aset baru.
     */
    public function create()
    {
        return view('assets.create');
    }

    /**
     * Menyimpan data aset baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'unique_id' => 'required|string|unique:assets,unique_id',
            'type' => 'required|in:mobil,device',
        ]);

        Asset::create($validatedData);

        return redirect()->route('assets.index')->with('success', 'Aset baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data aset.
     */
    public function edit(Asset $asset)
    {
        // [PERBAIKAN] Ambil semua driver yang statusnya 'available'
        $availableDrivers = Driver::where('status', 'available')->get();

        // Kirim data aset dan daftar driver yang tersedia ke view
        return view('assets.edit', [
            'asset' => $asset,
            'drivers' => $availableDrivers,
        ]);
    }

    /**
     * Mengupdate data aset dan menangani logika penugasan driver.
     */
    public function update(Request $request, Asset $asset)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'unique_id' => 'required|string|unique:assets,unique_id,' . $asset->id,
            'type' => 'required|in:mobil,device',
            'driver_id' => 'nullable|exists:drivers,id', // Boleh kosong, tapi jika diisi harus ada di tabel drivers
        ]);

        // --- [PERBAIKAN] LOGIKA CERDAS UNTUK PENUGASAN DRIVER ---

        $oldDriverId = $asset->driver_id;
        $newDriverId = $request->input('driver_id'); // Ambil driver_id dari request

        // 1. Jika ada driver lama yang ditugaskan, bebaskan tugasnya (set status ke 'available')
        if ($oldDriverId && $oldDriverId != $newDriverId) {
            $oldDriver = Driver::find($oldDriverId);
            if ($oldDriver) {
                $oldDriver->status = 'available';
                $oldDriver->save();
            }
        }

        // 2. Jika ada driver baru yang ditugaskan
        if ($newDriverId) {
            $newDriver = Driver::find($newDriverId);
            if ($newDriver) {
                $newDriver->status = 'on_duty'; // Set status driver baru menjadi 'on_duty'
                $newDriver->save();
            }
            // Otomatis set status aset menjadi 'aktif'
            $asset->status = 'aktif';
        } else {
            // Jika tidak ada driver yang ditugaskan (dilepas), set status aset menjadi 'standby'
            $asset->status = 'standby';
        }
        
        // Masukkan semua data ke dalam model Asset
        $asset->name = $validatedData['name'];
        $asset->unique_id = $validatedData['unique_id'];
        $asset->type = $validatedData['type'];
        $asset->driver_id = $newDriverId;
        
        // Simpan semua perubahan
        $asset->save();

        return redirect()->route('assets.index')->with('success', 'Data aset berhasil di-update!');
    }

    /**
     * Menghapus data aset dari database.
     */
    public function destroy(Asset $asset)
    {
        // Sebelum menghapus aset, pastikan driver yang terkait dibebaskan
        if ($asset->driver) {
            $asset->driver->status = 'available';
            $asset->driver->save();
        }

        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus!');
    }
}
