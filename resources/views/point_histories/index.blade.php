<!DOCTYPE html>
<html>
<head>
    <title>Buku Tabungan Poin Saya</title>
</head>
<body>
    <div>
        <h2>🪙 Poin Reward Saya</h2>
        <p style="color: gray;">Berikut adalah riwayat mutasi masuk dan keluar dari poin loyalty yang kamu kumpulkan.</p>
        
        <div style="margin-bottom: 20px;">
            <a href="{{ route('transactions.index') }}" style="color: #007bff; text-decoration: none; font-size: 14px;">← Kembali ke Riwayat Belanja</a>
        </div>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah Poin</th>
                </tr>
            </thead>
            <tbody>
                @if($histories->isEmpty())
                    <tr>
                        <td colspan="3" style="padding: 20px; text-align: center; color: gray;">Belum ada riwayat mutasi poin.</td>
                    </tr>
                @else
                    @foreach($histories as $h)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td>{{ $h->created_at->format('d M Y') }}</td>
                        <td><strong>{{ $h->description }}</strong></td>
                        <td>
                            @if($h->type == 'in')
                                <span style="color: #28a745;">+{{ $h->amount }} Pts</span>
                            @else
                                <span style="color: #dc3545;">-{{ $h->amount }} Pts</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>