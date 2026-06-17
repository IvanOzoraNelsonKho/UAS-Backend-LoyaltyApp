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

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID Order (Nota)</th>
                <th>Cabang Toko</th>
                <th>Daftar Menu Yang Dibeli & Atribut</th>
                <th>Total Bayar</th>
                <th>Bonus Poin Diperoleh</th>
                <th>Metode</th>
                <th>Status Pembuatan Menu</th>
                <th>Waktu Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $tx)
            <tr>
                <td><strong>{{ $tx->order_id }}</strong></td>
                <td>{{ $tx->merchant->name }}</td>
                <td>
                    <ul style="padding-left: 15px; margin: 0;">
                        @foreach($tx->details as $detail)
                            <li style="margin-bottom: 5px;">
                                <strong>{{ $detail->reward->name }}</strong> ({{ $detail->quantity }}x)<br>
                                <small style="color: #555; display: inline-block; margin-top: 2px;">
                                    Ukuran: {{ ucfirst($detail->size) }} | 
                                    Ice: {{ ucfirst($detail->ice_level) }} Ice | 
                                    Sugar: {{ ucfirst($detail->sugar_level) }} Sugar
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>Rp {{ number_format($tx->total_price, 0, ',', '.') }}</td>
                <td><strong style="color: blue;">+{{ $tx->details->count() * 20 }} Poin</strong></td>
                <td>{{ strtoupper($tx->payment_method) }}</td>
                <td>
                    <span style="background-color: #ffeeba; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold; display: inline-block;">
                        ⏳ {{ $tx->status }}
                    </span>
                </td>
                <td>{{ $tx->created_at->format('d M Y, H:i') }} WIB</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>