<!DOCTYPE html>
<html>
<head>
    <title>Admin - Kelola Penukaran Poin</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">

    <div style="max-width: 95%; background: #ffffff; margin: 20px auto; padding: 35px; border-radius: 16px; border: 2px solid #031344; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        
        <h1 style="text-align: center; color: #031344; margin-bottom: 5px;"> ADMIN PANEL </h1>
        <h3 style="text-align: center; color: #666; margin-top: 0; font-size: 16px; text-transform: uppercase;">Kelola Penukaran Poin Kopi & Minuman</h3>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="{{ route('admin.rewards.index') }}"><button style="padding: 10px 15px; cursor: pointer; font-weight: bold;">🍹 Kelola Katalog Menu</button></a>
            <a href="{{ url('/') }}"><button style="padding: 10px 15px; cursor: pointer;">🏠 Balik ke Home</button></a>
            
            <!-- NIH TOMBOL LOGOUT NYA -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" style="padding: 10px 15px; cursor: pointer; background-color: #dc3545; color: white; border: none; font-weight: bold; border-radius: 3px;">🚪 Logout</button>
            </form>
        </div>
        
        <hr style="border: 1px solid #031344; margin-bottom: 25px;">

        @if(session('success'))
            <div style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: bold;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <table border="1" cellpadding="12" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black; background-color: white;">
            <thead>
                <tr style="background-color: #f5baba; text-align: center;">
                    <th>ID Tukar</th>
                    <th>Nama Pelanggan</th>
                    <th>Minuman yang Diminta</th>
                    <th>Poin yang Dipotong</th>
                    <th>Waktu Pengajuan</th>
                    <th>Status Sekarang</th>
                    <th>Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($redemptions as $rdm)
                <tr>
                    <td style="text-align: center;"><strong>RDM-{{ str_pad($rdm->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                    <td><b>{{ $rdm->user->name ?? 'User Hilang' }}</b><br><small style="color:#666;">ID: #{{ $rdm->user_id }}</small></td>
                    <td><strong>{{ $rdm->reward->name ?? 'Menu Dihapus' }}</strong></td>
                    <td style="text-align: center; color: red; font-weight: bold;">-{{ number_format($rdm->points_spent ?? $rdm->reward->points_required, 0, ',', '.') }} Pts</td>
                    <td style="text-align: center;">{{ $rdm->created_at->format('d M Y, H:i') }} WIB</td>
                    <td style="text-align: center;">
                        @if($rdm->status == 'success')
                            <span style="background-color: #d4edda; color: #155724; padding: 6px 12px; border-radius: 20px; font-weight: bold; font-size: 13px;">✅ Sukses diambil</span>
                        @else
                            <span style="background-color: #ffeeba; color: #856404; padding: 6px 12px; border-radius: 20px; font-weight: bold; font-size: 13px;">⏳ Pending / Dibuat</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if($rdm->status == 'pending')
                            <form action="{{ route('admin.redemptions.updateStatus', $rdm->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="success">
                                <button type="submit" style="background-color: #28a745; color: white; padding: 8px 14px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                                    ☕ Selesaikan & Serahkan!
                                </button>
                            </form>
                        @else
                            <button disabled style="background-color: #ccc; color: #666; padding: 8px 14px; border: none; border-radius: 5px; cursor: not-allowed;">
                                Selesai
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #666; font-style: italic;">Belum ada user yang menukarkan poin malam ini, bos.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>