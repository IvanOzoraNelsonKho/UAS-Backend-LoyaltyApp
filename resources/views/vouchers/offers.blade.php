<html>
<head>
    <title>Kupon Promo</title>
</head>
<body>
    <h1>Daftar Kupon Promo</h1>
   
    <a href="/outlets">Daftar Outlet</a> | 
    <a href="/offers">Daftar Promo</a> | 
    <a href="/redeem">Tukar Poin</a>
    <br><br>

    <p>Gunakan kode promo di bawah ini saat memesan menu untuk mendapatkan diskon!</p>

    @if (session('success'))
        <p style="color: green;"><b>Berhasil:</b> {{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;"><b>Gagal:</b> {{ session('error') }}</p>
    @endif
    @if ($vouchers->isEmpty())
        <p>Belum ada promo yang tersedia saat ini.</p>
    @else
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width: 200px;">Kode Voucher</th>
                <th style="width: 150px;">Nilai Diskon</th>
                <th style="width: 150px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchers as $index => $voucher)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td style="text-align: center;"><b>{{ $voucher->code }}</b></td>
                <td>Diskon {{ $voucher->discount_value }}</td>
                <td style="text-align: center;">
                    {{ $voucher->is_used ? 'Sudah Terpakai' : 'Tersedia' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</body>
</html>