<html>
<head>
    <title>Daftar Outlet</title>
</head>
<<<<<<< HEAD
<body style="background-color: rgb(192, 219, 247);">
=======
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">
>>>>>>> 7e5b68390c010f333010030e719151da9d15cfa9
    <h1>Daftar Outlet</h1>
   
    <a href="/outlets">Daftar Outlet</a> | 
    <a href="/offers">Daftar Promo</a> | 
   
    <br><br>

    <p>Kunjungi outlet terdekat di kota Anda untuk menukarkan hadiah:</p>

    @if ($merchants->isEmpty())
        <p>Belum ada outlet yang tersedia saat ini.</p>
    @else
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width: 250px;">Nama Outlet</th>
                <th style="width: 250px;">Lokasi</th>
                <th style="width: 150px;">Kontak Info</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($merchants as $index => $merchant)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $merchant->name }}</td>
                <td>{{ $merchant->location }}</td>
                <td>{{ $merchant->contact_info ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <br><br>
    <a href="{{ route('merchants.index') }}">Kembali ke Halaman Admin (Kelola Merchant)</a>

</body>
</html>