<html>
<head>
    <title>Edit Voucher</title>
</head>
<body>
    <h1>Edit Voucher</h1>

    <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="code">Kode Voucher:</label><br>
        <input type="text" id="code" name="code" value="{{ $voucher->code }}" required><br><br>

        <label for="discount_value">Nilai Diskon:</label><br>
        <input type="number" id="discount_value" name="discount_value" value="{{ $voucher->discount_value }}" required><br><br>

        <button type="submit">Update Data</button>
    </form>

    <br>
    <a href="{{ route('vouchers.index') }}">Kembali ke Daftar Voucher</a>
</body>
</html>