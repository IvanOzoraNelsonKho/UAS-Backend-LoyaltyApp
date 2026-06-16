<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan Saya</title>
</head>
<body>
    <h1>Riwayat Pemesanan Online Anda</h1>
    <a href="{{ route('users.show', auth()->id()) }}"><button>⬅️ Kembali ke Profile</button></a> 
    <a href="{{ route('transactions.create') }}"><button>➕ Pesan Menu Online</button></a> | 
    <a href="{{ route('point_histories.index') }}"><button>💎 Lihat Histori Poin Yang di Kumpulkan</button></a>
    <hr>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID Order</th>
                <th>Cabang Toko</th>
                <th>Daftar Menu Yang Dibeli</th>
                <th>Total Bayar</th>
                <th>Bonus Poin Diperoleh</th>
                <th>Metode</th>
                <th>Status Pembuatan Menu</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $tx)
            <tr>
                <td>#ORD-{{ $tx->id }}</td>
                <td>{{ $tx->merchant->name }}</td>
                <td>
                    <ul>
                        @foreach($tx->details as $detail)
                            <li>{{ $detail->reward->name }} ({{ $detail->quantity }}x) @ Rp{{ number_format($tx->total_amount, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>Rp {{ number_with_delimiter($tx->total_amount) }}</td>
                <td><strong style="color: blue;">+{{ $tx->points_earned }} Poin</strong></td>
                <td>{{ strtoupper($tx->payment_method) }}</td>
                <td>
                    @if($tx->status == 'pending')
                        <span style="background-color: yellow; padding: 2px 5px;">⏳ Menunggu Konfirmasi Toko</span>
                    @elseif($tx->status == 'processing')
                        <span style="background-color: orange; padding: 2px 5px; color: white;">☕ Minuman Sedang Dibuat</span>
                    @elseif($tx->status == 'completed')
                        <span style="background-color: green; padding: 2px 5px; color: white;">✅ Selesai (Sudah Diambil)</span>
                    @else
                        <span style="background-color: red; padding: 2px 5px; color: white;">❌ Dibatalkan</span>
                    @endif
                </td>
                <td>{{ $tx->transaction_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>