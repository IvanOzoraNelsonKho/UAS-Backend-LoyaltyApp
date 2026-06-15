<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Poin - Chatime Loyalty App</title>
</head>
<body>
    <h1>Riwayat Aktivitas Poin Loyalty</h1>
    <a href="{{ route('transactions.index') }}">⬅️ Kembali ke Dashboard</a>
    <hr>

    {{-- Ringkasan Total Saldo Poin Akun Terkini --}}
    <h2>Total Poin Anda Saat Ini: <span style="color: blue;">{{ number_format(auth()->user()->point_balance) }} Poin</span></h2>
    
    <hr>
    <h3>Daftar Mutasi Poin</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Tanggal & Waktu</th>
                <th>Keterangan Aktivitas</th>
                <th>Jumlah Poin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pointHistories as $history)
                <tr>
                    <td>{{ $history->created_at->format('d M Y, H:i') }} WIB</td>
                    <td>{{ $history->description }}</td>
                    <td style="font-weight: bold; color: {{ $history->type === 'in' ? 'green' : 'red' }};">
                        {{ $history->type === 'in' ? '+' : '-' }}{{ number_format($history->amount) }} Poin
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: gray; font-style: italic;">
                        Belum ada riwayat mutasi poin loyalty pada akun Anda.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>