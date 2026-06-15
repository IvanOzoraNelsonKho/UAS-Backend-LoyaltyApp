<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>

    <h1>PROFILE</h1>
    
    <table border="1" cellpadding="12" cellspacing="0">
        <tr>
            <td>
                <h3>Nama Pelanggan:</h3>
                <h2>{{ $user->name }}</h2>
                
                <h3>Status Keanggotaan:</h3>
                <p><b>{{ $user->tier ? $user->tier->name : 'Bronze Member' }}</b></p>
                
                <h3>Total Saldo Poin Saat Ini:</h3>
                <p style="font-size: 24px; color: uppercase;">
                    <b>💰 {{ number_format($user->point_balance, 0, ',', '.') }} Pts</b>
                </p>
                
                <p><i>ID Member: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</i></p>
            </td>
        </tr>
    </table>

    <br>
    <hr>
    <h3>Informasi Detail Akun</h3>
    <ul>
        <li><b>Email Aktif:</b> {{ $user->email }}</li>
        <li><b>Tanggal Bergabung:</b> {{ $user->created_at ? $user->created_at->format('d M Y') : date('d M Y') }}</li>
    </ul>

    <br>
    <a href="{{ route('missions.index') }}"><button>🎮 Masuk ke Halaman Misi</button></a>
    <a href="/point-histories"><button>📜 Lihat Riwayat Mutasi Poin</button></a>

    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" style="color: red;">🚪 Keluar (Logout)</button>
</form>
</body>
</html>