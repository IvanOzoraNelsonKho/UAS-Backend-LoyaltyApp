<html>
<head>
    <title>Daftar Merchant</title>
</head>
<body>
    <h1>Daftar Merchant</h1>
   
    <a href="{{ route('merchants.index') }}">Tabel Merchant</a> | 
    <a href="{{ route('vouchers.index') }}">Tabel Voucher</a> | 
    <a href="{{ route('redemptions.index') }}">Tabel Redemption</a> |
    <a href="{{ route('transactions.create') }}">🛒 Pesan Online</a> | 
    <a href="{{ route('point_histories.index') }}">🪙 History Point</a> |
    <a href="{{ route('transactions.index') }}">📜 Riwayat Transaksi</a>
    <br><br>

<a href="{{ route('merchants.create') }}">Tambah Merchant</a>
<br><br>

@if ($merchants->isEmpty())
    <p>Belum ada merchant yang tersimpan</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 250px;">Nama Merchant</th>
            <th style="width: 250px;">Lokasi</th>
            <th style="width: 150px;">Kontak Info</th>
            <th style="width: 120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($merchants as $index => $merchant)
        <tr>
            <td style="text-align: center;">{{ $loop->iteration }}</td>
            <td>{{ $merchant->name }}</td>
            <td>{{ $merchant->location }}</td>
            <td>{{ $merchant->contact_info ?? '-' }}</td>
            <td style="text-align: center;">
                <a href="{{ route('merchants.edit', $merchant) }}">Ubah</a> |
                <form action="{{ route('merchants.destroy', $merchant) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus merchant ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif



</body>
</html>