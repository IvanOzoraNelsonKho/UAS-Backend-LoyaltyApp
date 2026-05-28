<html>
<head>
    <title>Tambah Voucher Baru</title>
</head>
<body>
    <h1>Tambah Voucher Baru</h1>

    <form action="{{ route('vouchers.store') }}" method="POST">
        @csrf
        
        <label for="code">Kode Voucher (Harus Unik):</label><br>
        <input type="text" id="code" name="code" required><br><br>

        <label for="discount_value">Nilai Diskon:</label><br>
        <input type="number" id="discount_value" name="discount_value" required><br><br>

        <button type="submit">Simpan Data</button>
    </form>

    <br>
    <a href="{{ route('vouchers.index') }}">Kembali ke Daftar Voucher</a>
</body>
</html>