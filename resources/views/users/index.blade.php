<!DOCTYPE html>
<html>
<head>
    <title>Kelola User - Admin Dashboard</title>
</head>
<body>
    <h1>Dashboard Admin: Kelola User</h1>
    
    <a href="{{ route('users.create') }}"><button>Tambah User Baru</button></a>
    <a href="{{ route('admin.orders.dashboard') }}"><button>☕ LIHAT ANTREAN PESANAN ONLINE</button></a>
    <a href="{{ route('tiers.index') }}"><button style="background-color: #e9ecef; cursor: pointer;">👑 KELOLA TIER MEMBERSHIP</button></a>
    <a href="{{ route('missions.index') }}"><button style="background-color: #e9ecef; cursor: pointer;">🎯 KELOLA MISSION</button></a>
    <a href="{{ route('redemptions.index') }}"><button style="background-color: #e9ecef; cursor: pointer;">🎁 KELOLA REDEMPTION</button></a>
    <a href="{{ route('merchants.index') }}"><button style="background-color: #e9ecef; cursor: pointer;">🏪 KELOLA MERCHANT</button></a>
    <a href="{{ url('/vouchers') }}"><button style="background-color: #e9ecef; cursor: pointer;">🎟️ KELOLA VOUCHER</button></a>
    <hr>
    <a href="{{ route('admin.rewards.index') }}"><button style="padding: 5px 10px; cursor: pointer; background-color: #f1c40f; border: 1px solid black; font-weight: bold;">🍹 KELOLA KATALOG MENU</button></a>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <div style= "border : 2px solid #031344; padding: 20px; background-color: #f9f9f9; border-radius: 40px; margin: 0 auto">
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black">
            <thead>
            <tr style="background-color: #8ca7d6">
                <div style= "font: 15px bold Georgia">
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
</div>
</body>
</html>