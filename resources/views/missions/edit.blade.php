<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Misi</title>
</head>
<body>
    <h1>Edit Data Misi</h1>
    <form action="{{ route('missions.update', $mission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nama Misi:</label><br>
            <input type="text" name="title" value="{{ $mission->title }}" required>
        </div>
        <br>
        <div>
            <label>Deskripsi:</label><br>
            <textarea name="description" rows="3" cols="30">{{ $mission->description }}</textarea>
        </div>
        <br>
        <div>
            <label>Hadiah Poin:</label><br>
            <input type="number" name="reward_points" value="{{ $mission->reward_points }}" required>
        </div>
        <br>
        <div>
            <label>Status:</label><br>
            <select name="status" required>
                <option value="1" {{ $mission->status == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $mission->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <br>
        <button type="submit">Update Misi</button>
    </form>
    <br>
    <a href="{{ route('missions.index') }}"><button>Kembali</button></a>
</body>
</html>