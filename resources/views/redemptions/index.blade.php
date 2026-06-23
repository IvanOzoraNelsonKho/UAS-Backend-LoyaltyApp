<html>
<head>
    <title>Daftar Redemption</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">
    <h1>Daftar Redemption</h1>

    <a href="{{ route('merchants.index') }}">Tabel Merchant</a> | 
    <a href="{{ route('vouchers.index') }}">Tabel Voucher</a> | 
    <a href="{{ route('redemptions.index') }}">Tabel Redemption</a>
    <br><br>

<br>

@if ($redemptions->isEmpty())
    <p>Belum ada data penukaran yang tersimpan</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 120px;">User</th>
            <th style="width: 120px;">Reward</th>
            <th style="width: 120px;">Outlet</th>
            <th style="width: 120px;">Status</th>
            <th style="width: 120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($redemptions as $index => $redemption)
        <tr>
            <td style="text-align: center;">{{ $loop->iteration }}</td>
            <td>{{ $redemption->user->name ?? 'Tanpa Nama' }}</td>
            <td>{{ $redemption->reward->name ?? 'Tanpa Hadiah' }}</td>
            <td>{{ $redemption->merchant->name ?? 'Tanpa Cabang' }}</td>
            <td>{{ ucfirst($redemption->status) }}</td>
            <td>
                <form action="{{ route('redemptions.updateStatus', $redemption->id) }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="status" value="success">
        
                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Yakin mau ACC pesanan ini?')">
                    Update ke Sukses
                </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

</body>
</html>