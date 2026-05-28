<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tier</title>
</head>
<body>
    <h1>Daftar Tier</h1>
    <a href="{{ route('tiers.create') }}"><button>Tambah Tier Baru</button></a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Tier</th>
                <th>Minimal Poin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiers as $tier)
                <tr>
                    <td>{{ $tier->id }}</td>
                    <td>{{ $tier->name }}</td>
                    <td>{{ $tier->min_points }}</td>
                    <td><a href="{{ route('tiers.edit', $tier->id) }}"><button>Edit</button></a>
                        <form action="{{ route('tiers.destroy', $tier->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus tier ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>