<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tier</title>
</head>
<body>
    <h1>Tambah Tier Baru</h1>
    <form action="{{ route('tiers.store') }}" method="POST">
        @csrf
        <div>
            <label>Nama Tier:</label><br>
            <input type="text" name="name" required>
        </div>
        <br>

        <div>
            <label>Minimal Poin:</label><br>
            <input type="number" name="min_points" required>
        </div>
        <br>

        <button type="submit">Simpan Data</button>
    </form>
    <br>
    <a href="{{ route('tiers.index') }}"><button>Kembali</button></a>
</body>
</html>