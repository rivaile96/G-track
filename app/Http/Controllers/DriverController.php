<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // <-- [PENTING] Panggil library PDF

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
            if ($driver->photo_path) {
                Storage::disk('public')->delete($driver->photo_path);
            }
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
        if ($driver->photo_path) {
            Storage::disk('public')->delete($driver->photo_path);
        }
        
        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Data driver berhasil dihapus!');
    }

    /**
     * [BARU] Men-generate PDF dari profil driver.
     */
    public function printPDF(Driver $driver)
    {
        // 1. Load view khusus untuk PDF dengan data driver
        $pdf = Pdf::loadView('drivers.print', ['driver' => $driver]);

        // 2. Set nama file yang akan di-download
        $fileName = 'driver-profile-' . $driver->id . '-' . \Illuminate\Support\Str::slug($driver->name) . '.pdf';

        // 3. Download file PDF
        return $pdf->download($fileName);
    }
}
