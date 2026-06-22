<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Dashboard Admin</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; margin: 20px;">

    <h1 style="color: #333; text-align: center; font: bold 35px Georgia; margin-bottom: 25px;">Dashboard Admin: Kelola User</h1>
    
    {{-- MENU NAVIGASI UTAMA --}}
    <div style="margin-bottom: 20px; text-align: center; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('users.create') }}"><button style="background-color: #e9ecef; cursor: pointer; padding: 10px 15px; font-weight: bold; border-radius: 6px;">➕ Tambah User Baru</button></a>
        <a href="{{ route('admin.orders.dashboard') }}"><button style="background-color: #e9ecef; cursor: pointer; padding: 10px 15px; font-weight: bold; border-radius: 6px;">☕ Kelola Antrean Pesanan Online</button></a>
        <a href="{{ route('tiers.index') }}"><button style="background-color: #e9ecef; cursor: pointer; padding: 10px 15px; font-weight: bold; border-radius: 6px;">👑 Kelola Tier Membership</button></a>
        <a href="{{ route('missions.index') }}"><button style="background-color: #e9ecef; cursor: pointer; padding: 10px 15px; font-weight: bold; border-radius: 6px;">🎯 Kelola Misi</button></a>
        <a href="{{ route('admin.rewards.index') }}"><button style="background-color: #e9ecef; cursor: pointer; padding: 10px 15px; font-weight: bold; border-radius: 6px;">🍹 Kelola Katalog Menu</button></a>
    </div>

    @if(session('success'))
        <p style="color: green; font-weight: bold; text-align: center;">✅ {{ session('success') }}</p>
    @endif

    {{-- KOTAK TABEL UTAMA --}}
    <div style="border: 2px solid #031344; padding: 25px; background-color: #f9f9f9; border-radius: 16px; max-width: 1200px; margin: 0 auto; box-shadow: 0 8px 20px rgba(0,0,0,0.05);">
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black;">
            <thead>
                <tr style="background-color: #8ca7d6; font-family: Georgia, serif; font-size: 15px; font-weight: bold;">
                    <th>Nama</th>
                    <th>Alamat Email</th>
                    <th>Role Sistem</th>
                    <th>Total Saldo Poin</th>
                    <th>Tier Membership</th>
                    <th>Kode Referral</th>
                    <th style="text-align: center;">Aksi Kelola</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="background-color: #ffffff;">
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span style="color: red; font-weight: bold; background: #fff5f5; padding: 2px 8px; border: 1px solid #fed7d7; border-radius: 4px;">Admin</span>
                        @else
                            <span style="color: #4a5568; font-weight: bold;">Customer</span>
                        @endif
                    </td>
                    <td><strong>{{ number_format($user->point_balance, 0, ',', '.') }} Poin</strong></td>
                    <td>{{ $user->tier->name ?? 'Belum Ada Tier' }}</td>
                    <td><code style="background: #edf2f7; padding: 2px 6px; border-radius: 4px;">{{ $user->referral_code ?? '-' }}</code></td>
                    <td style="text-align: center; white-space: nowrap;">
                        
                        <a href="{{ route('admin.users.pointHistory', $user->id) }}" style="text-decoration: none;">
                            <button style="background-color: #17a2b8; color: white; cursor: pointer; padding: 6px 12px; font-weight: bold; border: none; border-radius: 4px; margin-right: 4px;">
                                💎 Histori Poin
                            </button>
                        </a>

                        <a href="{{ route('users.edit', $user->id) }}" style="text-decoration: none;">
                            <button style="padding: 6px 12px; cursor: pointer; font-weight: bold; border-radius: 4px; border: 1px solid #ccc; background: #fff; margin-right: 4px;">✏️ Edit</button>
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block; margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda benar-benar yakin ingin menghapus permanen akun user ini? Tindakan ini tidak dapat dibatalkan.');" style="background-color: #dc3545; color: white; padding: 6px 12px; cursor: pointer; font-weight: bold; border: none; border-radius: 4px;">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="text-align: center; margin-top: 25px;">
        <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
            @csrf
            <button type="submit" style="padding: 10px 20px; cursor: pointer; background-color: #dc3545; color: white; border: none; font-weight: bold; border-radius: 6px;">🚪 Keluar (Logout)</button>
        </form>
    </div>
</body>
</html>