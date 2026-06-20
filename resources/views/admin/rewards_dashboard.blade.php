<!DOCTYPE html>
<html>
<head>
    <title>Admin - Kelola Katalog Poin</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">

    <div style="max-width: 900px; background: #ffffff; margin: 20px auto; padding: 35px; border-radius: 16px; border: 2px solid #031344; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        
        <h1 style="text-align: center; color: #031344; margin-bottom: 5px;">👑 ADMIN PANEL 👑</h1>
        <h3 style="text-align: center; color: #666; margin-top: 0; font-size: 16px;">Kelola Menu Minuman</h3>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="{{ route('admin.redemptions.index') }}"><button style="padding: 10px 15px; cursor: pointer;">📋 Kelola Penukaran User</button></a>
            <a href="{{ url('/') }}"><button style="padding: 10px 15px; cursor: pointer;">🏠 Balik ke Home</button></a>
        </div>
        
        <hr style="border: 1px solid #031344; margin-bottom: 25px;">

        @if(session('success'))
            <div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: bold;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Form nambah menu -->
        <div style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; border: 1px dashed #031344; margin-bottom: 30px;">
            <h3 style="margin-top: 0; color: #031344;">➕ Tambah Menu Baru</h3>
            <form action="{{ route('admin.rewards.store') }}" method="POST" style="display: flex; gap: 10px;">
                @csrf
                <input type="text" name="name" placeholder="Nama Minuman" required style="flex: 2; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                <input type="number" name="points_required" placeholder="Harga Poin" required style="flex: 1; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                <button type="submit" style="padding: 10px 20px; background-color: #031344; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">Simpan</button>
            </form>
        </div>

        <!-- Tabel daftarnya -->
        <table border="1" cellpadding="12" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black; background-color: white;">
            <thead>
                <tr style="background-color: #8ca7d6; text-align: center;">
                    <th>ID</th>
                    <th>Nama Minuman</th>
                    <th>Harga Poin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rewards as $item)
                <tr>
                    <td style="text-align: center;"><strong>#{{ $item->id }}</strong></td>
                    <td><b>{{ $item->name }}</b></td>
                    <td style="text-align: center; color: blue; font-weight: bold;">{{ number_format($item->points_required, 0, ',', '.') }} Pts</td>
                    <td style="text-align: center;">
                        <form action="{{ route('admin.rewards.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin apus nih?');">
                            @csrf
                            <button type="submit" style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer;">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Katalog kosong bos.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>