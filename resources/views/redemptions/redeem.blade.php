<html>
<head>
    <title>Tukar Poin</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">
    <h1>Tukar Poin</h1>
   
    <a href="/outlets">Daftar Outlet</a> | 
    <a href="/offers">Daftar Promo</a> | 
    <a href="/redeem">Tukar Poin</a>
    <br><br>

    <p>Pilih akun, hadiah yang diinginkan, dan lokasi pengambilan:</p>

    @if (session('error'))
        <p style="color: red;"><b>Gagal:</b> {{ session('error') }}</p>
    @endif

    @if (session('success'))
        <p style="color: green;"><b>Berhasil:</b> {{ session('success') }}</p>
    @endif

    <form action="{{ route('redemptions.store') }}" method="POST">
        @csrf
        <table border="1" cellpadding="5" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width: 200px;"><b>Pilih Akun (Login)</b></td>
                    <td style="width: 300px;">
                        <select name="user_id" required style="width: 100%;">
                            <option value="">-- Pilih Akun --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} (Sisa Poin: {{ $user->point_balance }})</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Pilih Hadiah</b></td>
                    <td>
                        <select name="reward_id" required style="width: 100%;">
                            <option value="">-- Pilih Hadiah --</option>
                            @foreach($rewards as $reward)
                                <option value="{{ $reward->id }}">{{ $reward->name }} - {{ $reward->points_required }} Poin</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Pilih Outlet Pengambilan</b></td>
                    <td>
                        <select name="merchant_id" required style="width: 100%;">
                            <option value="">-- Pilih Outlet --</option>
                            @foreach($merchants as $merchant)
                                <option value="{{ $merchant->id }}">{{ $merchant->name }} ({{ $merchant->location }})</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <br>
        <button type="submit">Tukar Poin Sekarang</button>
    </form>

    <br><br>
    <a href="{{ route('redemptions.index') }}">Kembali ke Halaman Admin (Kelola Redemption)</a>

</body>
</html>