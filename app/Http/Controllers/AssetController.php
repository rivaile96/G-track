<?php

namespace App\Http\Controllers;

// Kita panggil Model 'Asset' agar bisa berinteraksi dengan tabel 'assets'
use App\Models\Asset;
// Kita panggil class 'Request' untuk menangani data yang dikirim dari form
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Menampilkan halaman utama Manajemen Aset (daftar semua aset).
     * Method ini akan dipanggil oleh route GET /assets
     */
    public function index()
    {
        // Ambil semua data dari tabel 'assets' dan urutkan dari yang terbaru.
        $assets = Asset::latest()->get();

        // Kirim data tersebut ke view 'assets.index'
        return view('assets.index', ['assets' => $assets]);
    }

    /**
     * Menampilkan form untuk membuat aset baru.
     * Method ini akan dipanggil oleh route GET /assets/create
     */
    public function create()
    {
        // Hanya menampilkan halaman yang berisi form.
        return view('assets.create');
    }

    /**
     * Menyimpan data aset baru yang dikirim dari form ke database.
     * Method ini akan dipanggil oleh route POST /assets
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'unique_id' => 'required|string|unique:assets,unique_id',
            'type' => 'required|in:mobil,device',
        ]);

        // Jika validasi berhasil, simpan data ke database.
        Asset::create($validatedData);

        // Redirect pengguna kembali ke halaman daftar aset dengan pesan sukses.
        return redirect()->route('assets.index')->with('success', 'Aset baru berhasil ditambahkan!');
    }

    /**
     * Menghapus data aset dari database.
     * Method ini akan dipanggil oleh route DELETE /assets/{asset}
     */
    public function destroy(Asset $asset)
    {
        // Langsung hapus data aset yang dipilih (Laravel otomatis mencarikannya untuk kita)
        $asset->delete();

        // Redirect kembali ke halaman daftar aset dengan pesan sukses.
        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus!');
    }
}
