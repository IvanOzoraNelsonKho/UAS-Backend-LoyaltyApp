<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Misi</title>
</head>
<body>
    <h1>Edit Data Misi</h1>
    
    <form action="{{ route('missions.update', $mission->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Nama Misi:</label><br>
        <input type="text" name="title" value="{{ $mission->title }}" required><br><br>

        <label>Deskripsi Misi:</label><br>
        <textarea name="description" rows="4" cols="30">{{ $mission->description }}</textarea><br><br>

        <label>Hadiah Poin (Integer):</label><br>
        <input type="number" name="reward_points" value="{{ $mission->reward_points }}" min="0" required><br><br>

        <label>Status Aktif Misi:</label><br>
        <select name="status" required>
            <option value="1" {{ $mission->status == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $mission->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
        </select><br><br>

        <button type="submit">Update Data Misi</button>
    </form>
    
    <br>
    <a href="{{ route('missions.index') }}"><button>Batal & Kembali</button></a>
</body>
</html>