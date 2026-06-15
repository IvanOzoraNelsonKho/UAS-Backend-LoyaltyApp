<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Misi Baru</title>
</head>
<body>
    <h1>Tambah Misi Baru</h1>
    
    <form action="{{ route('missions.store') }}" method="POST">
        @csrf
        
        <label>Nama Misi:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Deskripsi Misi:</label><br>
        <textarea name="description" rows="4" cols="30"></textarea><br><br>

        <label>Hadiah Poin (Integer):</label><br>
        <input type="number" name="reward_points" min="0" required><br><br>

        <label>Status Aktif Misi:</label><br>
        <select name="status" required>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select><br><br>

        <button type="submit">Simpan Misi Baru</button>
    </form>
    
    <br>
    <a href="{{ route('missions.index') }}"><button>Batal & Kembali</button></a>
</body>
</html>