<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
</head>
<body>
    <h1>Dashboard Admin: Kelola User</h1>
    <a href="{{ route('users.create') }}"><button>Tambah User Baru</button></a>
    <br><br>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Saldo Poin</th>
                <th>ID Tier</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->point_balance }}</td>
                <td>{{ $user->tier_id }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}"><button>Edit</button></a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ route('tiers.index') }}"><button>Ke Dashboard Tiers</button></a> |
    <a href="{{ route('missions.index') }}"><button>Ke Dashboard Misi</button></a> |
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" style="color: red;">🚪 Keluar (Logout)</button>
    </form>
</body>
</html>