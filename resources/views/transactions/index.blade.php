<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi</title>
</head>
<body>
    <h1>Riwayat Transaksi & Poin Saya</h1>
    <p>Pantau terus transaksi kamu dan kumpulkan point reaward sebanyak-banyaknya !</p>
    <!-- jadi route ini buat nambah transaksi baru, terus nanti kalau di klik bakal ke halaman create.blade.php -->
    <a href="{{ route('transactions.create') }}"><strong>Klaim Nota Baru</strong></a>

    <!-- ini buat tampilin kata sukses kalau transaksinya berhasil ditambahkan -->
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID Nota</th>
                <th>Tanggal Belanja</th>
                <th>Total Transaksi</th>
                <th>Poin yang Didapat</th>
            </tr>
        </thead>

        <!-- ini buat nampilin data transaksi -->
        <tbody>
            @if($transactions->isEmpty())
                <tr>
                    <td colspan="5" align="center">Belum ada data transaksi.</td>
                </tr>
            @else
            <!-- Cari bagian kode ini di index.blade.php kamu dan sesuaikan kolomnya -->
            @foreach($transactions as $t)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px; color: #007bff; font-weight: bold;">{{ $t->invoice_number }}</td> <!-- Menampilkan Nomor Nota asli -->
                <td style="padding: 12px;">{{ $t->transaction_date }}</td>
                <td style="padding: 12px; font-weight: bold;">Rp {{ number_format($t->total_amount, 0, ',', '.') }}</td>
                <td style="padding: 12px; color: #28a745; font-weight: bold;">+{{ $t->points_earned }} Pts</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>