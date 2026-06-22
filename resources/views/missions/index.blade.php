<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Misi</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; margin: 20px;">

    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif
    @if(session('error'))
        <p style="color: red;"><b>{{ session('error') }}</b></p>
    @endif

    @if(auth()->user() && auth()->user()->is_admin)
        <h1>Dashboard Admin: Kelola Misi Harian</h1>
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
                    <td>{{ $mission->reward_points }} Pts</td>
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
        <a href="{{ route('users.index') }}"><button>Ke Dashboard Users</button></a> |
        <a href="{{ route('tiers.index') }}"><button>Ke Dashboard Tiers</button></a> |

    @else
        <h1>Daftar Misi Loyalitas Saya</h1>
        <p>Selesaikan misi seru di bawah ini untuk mengumpulkan poin belanja gratisan!</p>
        <br>

        <ul>
            @foreach($missions->where('status', 1) as $mission)
                <li>
                    <h3>{{ $mission->title }}</h3>
                    <p><strong>Hadiah:</strong> {{ $mission->reward_points }} Poin</p>
                    <p><strong>Deskripsi:</strong> {{ $mission->description }}</p>
                    
                    <form action="{{ route('missions.claim', $mission->id) }}" method="POST">
                        @csrf
                        <button type="submit">Selesaikan & Ambil Hadiah Poin</button>
                    </form>
                    <br>
                    <hr>
                </li>
            @endforeach
        </ul>

        <br>
        <a href="{{ auth()->check() ? route('users.show', auth()->id()) : '/users/1' }}"><button>Kembali ke Profil Saya</button></a>
    @endif

    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" style="color: red;">🚪 Keluar (Logout)</button>
    </form>

</body>
</html>