<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Menampilkan daftar semua aset. (Read)
     */
    public function index()
    {
        $assets = Asset::latest()->get();
        return view('assets.index', ['assets' => $assets]);
    }

    /**
     * Menampilkan form untuk membuat aset baru. (Create - Form)
     */
    public function create()
    {
        return view('assets.create');
    }

    /**
     * Menyimpan data aset baru ke database. (Create - Process)
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'unique_id' => 'required|string|unique:assets,unique_id',
            'type' => 'required|in:mobil,device',
        ]);

        // Simpan data ke database
        Asset::create($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('assets.index')->with('success', 'Aset baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data aset. (Update - Form)
     */
    public function edit(Asset $asset)
    {
        // Kirim data aset yang akan diedit ke view 'assets.edit'
        return view('assets.edit', ['asset' => $asset]);
    }

    /**
     * Mengupdate data aset di database. (Update - Process)
     */
    public function update(Request $request, Asset $asset)
    {
        // Validasi data yang masuk dari form edit
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Rule 'unique' diubah agar mengabaikan unique_id dari aset yang sedang diedit
            'unique_id' => 'required|string|unique:assets,unique_id,' . $asset->id,
            'type' => 'required|in:mobil,device',
            'status' => 'required|in:aktif,standby,maintenance', // Tambahkan validasi untuk status
        ]);

        // Update data di database
        $asset->update($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('assets.index')->with('success', 'Data aset berhasil di-update!');
    }

    /**
     * Menghapus data aset dari database. (Delete)
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus!');
    }
}