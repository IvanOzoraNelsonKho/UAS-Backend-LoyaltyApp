<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Kelola Pesanan</title>
</head>
<body>
    <h1>☕ Dashboard Admin - Antrean Pesanan Masuk</h1>
    <a href="{{ route('users.index') }}"><button>⬅️ Kembali ke Kelola User</button></a>
    <hr>

    @if(session('success'))
        <p style="color: green; font-weight: bold; background-color: #d4edda; padding: 10px; border-radius: 5px;">
            {{ session('success') }}
        </p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #333; color: white;">
                <th>Nota (Order ID)</th>
                <th>Nama Customer</th>
                <th>No. Telepon</th>
                <th>Cabang Toko</th>
                <th>Menu & Atribut Minuman</th>
                <th>Total Pembayaran</th>
                <th>Metode Bayar</th>
                <th>Waktu Masuk</th>
                <th>Aksi Kontrol Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $tx)
            <tr>
                <td><strong>{{ $tx->order_id }}</strong></td>
                <td>{{ $tx->recipient_name }} (Akun: {{ $tx->user->name ?? 'Guest' }})</td>
                <td>{{ $tx->recipient_phone }}</td>
                <td>{{ $tx->merchant->name ?? 'Cabang Tidak Diketahui' }}</td>
                <td>
                    <ul style="padding-left: 15px; margin: 0;">
                        @foreach($tx->details as $detail)
                            <li>
                                <strong>{{ $detail->reward->name ?? 'Menu' }}</strong> ({{ $detail->quantity }}x)<br>
                                <small style="color: #555;">
                                    Size: {{ ucfirst($detail->size) }} | 
                                    Ice: {{ ucfirst($detail->ice_level) }} | 
                                    Sugar: {{ ucfirst($detail->sugar_level) }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>Rp {{ number_format($tx->total_price, 0, ',', '.') }}</td>
                <td>{{ strtoupper($tx->payment_method) }} {{ $tx->bank_name ? '('.$tx->bank_name.')' : '' }}</td>
                <td>{{ $tx->created_at->format('d M, H:i') }} WIB</td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $tx->id) }}" method="POST">
                        @csrf
                        <select name="status" style="padding: 5px; font-weight: bold;">
                            <option value="Pesanan sedang diproses" {{ $tx->status == 'Pesanan sedang diproses' ? 'selected' : '' }}>⏳ Diproses</option>
                            <option value="☕ Minuman Sedang Dibuat" {{ $tx->status == '☕ Minuman Sedang Dibuat' ? 'selected' : '' }}>☕ Sedang Dibuat</option>
                            <option value="✅ Selesai (Sudah Diambil)" {{ $tx->status == '✅ Selesai (Sudah Diambil)' ? 'selected' : '' }}>✅ Selesai</option>
                            <option value="❌ Dibatalkan" {{ $tx->status == '❌ Dibatalkan' ? 'selected' : '' }}>❌ Batalkan</option>
                        </select>
                        <button type="submit" style="padding: 5px; background-color: #007bff; color: white; cursor: pointer;">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; color: gray; font-style: italic;">Belum ada pesanan online yang masuk saat ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>