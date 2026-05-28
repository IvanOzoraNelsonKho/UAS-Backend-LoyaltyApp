<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Misi</title>
</head>
<body>
    <h1>Tambah Misi Baru</h1>
    <form action="{{ route('missions.store') }}" method="POST">
        @csrf
        <div>
            <label>Nama Misi:</label><br>
            <input type="text" name="title" required>
        </div>
        <br>
        <div>
            <label>Deskripsi:</label><br>
            <textarea name="description" rows="3" cols="30"></textarea>
        </div>
        <br>
        <div>
            <label>Hadiah Poin:</label><br>
            <input type="number" name="reward_points" required>
        </div>
        <br>
        <div>
            <label>Status:</label><br>
            <select name="status" required>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
        <br>
        <button type="submit">Simpan Misi</button>
    </form>
    <br>
    <a href="{{ route('missions.index') }}"><button>Kembali</button></a>
</body>
</html>