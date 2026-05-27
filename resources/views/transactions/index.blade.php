<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi</title>
</head>
<body>
    <h1>Riwayat Transaksi Loyalty App</h1>
    
    <!-- jadi route ini buat nambah transaksi baru, terus nanti kalau di klik bakal ke halaman create.blade.php -->
    <a href="{{ route('transactions.create') }}"><strong>+ Tambah Transaksi Baru</strong></a>
    <br><br>


    <!-- ini buat tampilin kata sukses kalau transaksinya berhasil ditambahkan -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Total Belanja</th>
                <th>Poin yang Didapat</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>

        <!-- ini buat nampilin data transaksi -->
        <tbody>
            @if($transactions->isEmpty())
                <tr>
                    <td colspan="5" align="center">Belum ada data transaksi.</td>
                </tr>
            @else
                @foreach($transactions as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td><strong>{{ $t->user->name ?? 'User Tidak Ditemukan' }}</strong></td>
                    <td>Rp {{ number_format($t->total_amount, 0, ',', '.') }}</td>
                    <td>+{{ $t->points_earned }} Pts</td>
                    <td>{{ $t->transaction_date }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>