<!DOCTYPE html>
<html>
<head>
    <title>Kelola User - Admin Dashboard</title>
</head>
<body>
    <h1>Dashboard Admin: Kelola User</h1>
    
    <a href="{{ route('users.create') }}"><button>Tambah User Baru</button></a>
    <a href="{{ route('admin.orders.dashboard') }}"><button>☕ LIHAT ANTREAN PESANAN ONLINE</button></a>
    <hr>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Total Saldo Poin</th>
                <th>Tier Membership</th>
                <th>Kode Referral</th>
                <th>Aksi Kelola</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->is_admin)
                        <span style="color: red; font-weight: bold;">Admin</span>
                    @else
                        <span>Customer</span>
                    @endif
                </td>
                <td>{{ number_format($user->point_balance) }} Poin</td>
                <td>{{ $user->tier->name ?? 'Belum Ada Tier' }}</td>
                <td><code>{{ $user->referral_code ?? '-' }}</code></td>
                <td>
                    <a href="{{ route('admin.users.pointHistory', $user->id) }}">
                        <button style="background-color: #17a2b8; color: white; cursor: pointer; padding: 5px 10px;">
                            💎 Histori Poin
                        </button>
                    </a>

                    <a href="{{ route('users.edit', $user->id) }}">
                        <button style="padding: 5px 10px; cursor: pointer;">✏️ Edit</button>
                    </a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?')" style="background-color: #dc3545; color: white; padding: 5px 10px; cursor: pointer;">
                            🗑️ Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>