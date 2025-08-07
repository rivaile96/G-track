<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Driver - {{ $driver->name }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 24px; }
        .profile-photo { float: left; width: 150px; height: 150px; object-fit: cover; border-radius: 8px; margin-right: 20px; }
        .profile-info { overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; width: 150px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Profil Lengkap Driver</h1>
        </div>

        <div>
            @if($driver->photo_path)
                {{-- Mengambil path absolut dari gambar untuk PDF --}}
                <img src="{{ public_path('storage/' . $driver->photo_path) }}" alt="{{ $driver->name }}" class="profile-photo">
            @endif
            <div class="profile-info">
                <table>
                    <tr><th>Nama Lengkap</th><td>{{ $driver->name }}</td></tr>
                    <tr><th>Status</th><td>{{ ucfirst($driver->status) }}</td></tr>
                    <tr><th>No. Telepon</th><td>{{ $driver->phone_number }}</td></tr>
                    <tr><th>No. KTP</th><td>{{ $driver->ktp_number }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $driver->address ?? '-' }}</td></tr>
                    <tr><th>Tipe SIM</th><td>{{ $driver->sim_type }}</td></tr>
                    <tr><th>No. SIM</th><td>{{ $driver->sim_number }}</td></tr>
                    <tr><th>SIM Kadaluarsa</th><td>{{ \Carbon\Carbon::parse($driver->sim_expiry_date)->format('d F Y') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
