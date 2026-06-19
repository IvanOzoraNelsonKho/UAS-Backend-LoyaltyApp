<!DOCTYPE html>
<html>
<head>
    <title>Admin - Riwayat Poin User</title>
</head>
<body>
    <h1>💎 Riwayat Aktivitas Poin: {{ $user->name }}</h1>
    <p>Email User: {{ $user->email }}</p>
    <p>Total Saldo Poin Saat Ini: <span style="color: blue; font-weight: bold;">{{ number_format($user->point_balance) }} Poin</span></p>
    
    <a href="{{ route('users.index') }}"><button>⬅️ Kembali ke Kelola User</button></a>
    <a href="{{ route('admin.orders.dashboard') }}"><button>☕ Ke Dashboard Pesanan</button></a>
    <hr>

    <h3>Daftar Mutasi Poin Keluar / Masuk</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; text-align: left;">
        <thead>
            <tr style="background-color: #333; color: white;">
                <th>Tanggal & Waktu</th>
                <th>Keterangan Aktivitas / transaksi</th>
                <th>Jenis Mutasi</th>
                <th>Jumlah Poin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pointHistories as $history)
                <tr>
                    <td>{{ $history->created_at->format('d M Y, H:i') }} WIB</td>
                    <td>{{ $history->description }}</td>
                    <td>
                        @if($history->type === 'in')
                            <span style="background-color: #d4edda; color: green; padding: 3px 5px; border-radius: 3px; font-weight: bold;">Masuk (In)</span>
                        @else
                            <span style="background-color: #f8d7da; color: red; padding: 3px 5px; border-radius: 3px; font-weight: bold;">Keluar (Out)</span>
                        @endif
                    </td>
                    <td style="font-weight: bold; color: {{ $history->type === 'in' ? 'green' : 'red' }};">
                        {{ $history->type === 'in' ? '+' : '-' }}{{ number_format($history->amount) }} Poin
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: gray; font-style: italic;">
                        User ini belum memiliki riwayat aktivitas mutasi poin loyalty.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>