<html>
<head>
    <title>Daftar Redemption</title>
</head>
<body>
    <h1>Daftar Redemption</h1>

<a href="{{ route('redemptions.create') }}">Tambah Data Penukaran</a>
<br><br>

@if ($redemptions->isEmpty())
    <p>Belum ada data penukaran yang tersimpan</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 120px;">ID User</th>
            <th style="width: 120px;">ID Reward (Voucher)</th>
            <th style="width: 120px;">ID Merchant</th>
            <th style="width: 120px;">Status</th>
            <th style="width: 120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($redemptions as $index => $redemption)
        <tr>
            <td style="text-align: center;">{{ $loop->iteration }}</td>
            <td>{{ $redemption->user_id }}</td>
            <td>{{ $redemption->reward_id }}</td>
            <td>{{ $redemption->merchant_id }}</td>
            <td>{{ ucfirst($redemption->status) }}</td>
            <td style="text-align: center;">
                <a href="{{ route('redemptions.edit', $redemption) }}">Ubah</a> |
                <form action="{{ route('redemptions.destroy', $redemption) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus data penukaran ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<br>
<a href="{{ route('vouchers.index') }}">Ke Halaman Voucher</a>
</body>
</html>