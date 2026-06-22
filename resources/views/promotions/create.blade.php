<!DOCTYPE html>
<html>
<head>
    <title>Tambah Promo Baru</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">
    <h1>Buat Promo Baru</h1>
    <form action="{{ route('promotions.store') }}" method="POST">
        @csrf

        <label>Judul Promo:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="description" required rows="3"></textarea><br><br>

        <label>Multiplier Poin (Angka):</label><br>
        <input type="number" name="multiplier" required><br><br>

        <label>Berlaku Sampai:</label><br>
        <input type="date" name="end_date" required><br><br>

        <button type="submit">Simpan Promo</button>
    </form>
    <br>
    <a href="{{ route('promotions.index') }}">Batal & Kembali</a>
</body>
</html>

