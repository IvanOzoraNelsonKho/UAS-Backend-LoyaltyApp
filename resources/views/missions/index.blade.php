<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Misi</title>
</head>
<body>
    <h1>Daftar Misi</h1>
    <a href="{{ route('missions.create') }}"><button>Tambah Misi Baru</button></a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Misi</th>
                <th>Deskripsi</th>
                <th>Hadiah Poin</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($missions as $mission)
            <tr>
                <td>{{ $mission->id }}</td>
                <td>{{ $mission->title }}</td>
                <td>{{ $mission->description }}</td>
                <td>{{ $mission->reward_points }}</td>
                <td>{{ $mission->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                <td>
                    <a href="{{ route('missions.edit', $mission->id) }}"><button>Edit</button></a>
                    <form action="{{ route('missions.destroy', $mission->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus misi ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('tiers.index') }}"><button>Ke Halaman Tiers</button></a>
</body>
</html>