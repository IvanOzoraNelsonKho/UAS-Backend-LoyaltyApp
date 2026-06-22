<html>
<head>
    <title>Tambah Merchant Baru</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">
    <h1>Tambah Merchant Baru</h1>

<form action="{{ route('merchants.store') }}" method="POST">
    @csrf
    
    <label for="name">Nama Merchant:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="location">Lokasi:</label><br>
    <input type="text" id="location" name="location" required><br><br>

    <label for="contact_info">Kontak Info:</label><br>
    <input type="text" id="contact_info" name="contact_info"><br><br>

    <button type="submit">Simpan Merchant</button>
</form>

<br>
<a href="{{ route('merchants.index') }}">Kembali ke Daftar</a>

</body>
</html>