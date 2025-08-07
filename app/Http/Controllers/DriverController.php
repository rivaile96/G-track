<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- [PENTING] Untuk mengelola file foto

class DriverController extends Controller
{
    /**
     * Menampilkan halaman daftar semua driver (galeri kartu).
     */
    public function index()
    {
        $drivers = Driver::latest()->get();
        return view('drivers.index', ['drivers' => $drivers]);
    }

    /**
     * Menampilkan form untuk membuat driver baru.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Menyimpan data driver baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:drivers,phone_number',
            'ktp_number' => 'required|string|unique:drivers,ktp_number',
            'sim_type' => 'required|string',
            'sim_number' => 'required|string|unique:drivers,sim_number',
            'sim_expiry_date' => 'required|date',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('driver-photos', 'public');
            $validatedData['photo_path'] = $path;
        }

        Driver::create($validatedData);

        return redirect()->route('drivers.index')->with('success', 'Driver baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman profil detail dari satu driver.
     */
    public function show(Driver $driver)
    {
        return view('drivers.show', ['driver' => $driver]);
    }

    /**
     * Menampilkan form untuk mengedit data driver.
     */
    public function edit(Driver $driver)
    {
        return view('drivers.edit', ['driver' => $driver]);
    }

    /**
     * Mengupdate data driver di database.
     */
    public function update(Request $request, Driver $driver)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:drivers,phone_number,' . $driver->id,
            'ktp_number' => 'required|string|unique:drivers,ktp_number,' . $driver->id,
            'sim_type' => 'required|string',
            'sim_number' => 'required|string|unique:drivers,sim_number,' . $driver->id,
            'sim_expiry_date' => 'required|date',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($driver->photo_path) {
                Storage::disk('public')->delete($driver->photo_path);
            }
            // Upload foto baru
            $path = $request->file('photo')->store('driver-photos', 'public');
            $validatedData['photo_path'] = $path;
        }

        $driver->update($validatedData);

        return redirect()->route('drivers.index')->with('success', 'Data driver berhasil di-update!');
    }

    /**
     * Menghapus data driver dari database.
     */
    public function destroy(Driver $driver)
    {
        // Hapus foto dari storage sebelum menghapus data dari database
        if ($driver->photo_path) {
            Storage::disk('public')->delete($driver->photo_path);
        }
        
        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Data driver berhasil dihapus!');
    }
}
