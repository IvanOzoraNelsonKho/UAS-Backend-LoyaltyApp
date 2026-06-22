<html>
<head>
    <title>Tambah Data Redemption</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">
    <h1>Tambah Data Penukaran</h1>

    <form action="{{ route('redemptions.store') }}" method="POST">
        @csrf
        
        <label for="user_id">Nama User:</label><br>
        <select id="user_id" name="user_id" required>
            <option value="">Pilih User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select><br><br>

        <label for="reward_id">Reward:</label><br>
        <select id="reward_id" name="reward_id" required>
            <option value="">Pilih Promo</option>
            @foreach($rewards as $reward)
                <option value="{{ $reward->id }}">{{ $reward->name }}</option>
            @endforeach
        </select><br><br>

        <label for="merchant_id">Outlet:</label><br>
        <select id="merchant_id" name="merchant_id" required>
            <option value="">Pilih Merchant</option>
            @foreach($merchants as $merchant)
                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
            @endforeach
        </select><br><br>

        <label for="status">Status Penukaran:</label><br>
        <select id="status" name="status" required>
            <option value="pending">Pending</option>
            <option value="success">Success</option>
            <option value="failed">Failed</option>
        </select><br><br>

        <button type="submit">Simpan Data</button>
    </form>

    <br>
    <a href="{{ route('redemptions.index') }}">Kembali ke Daftar Penukaran</a>
</body>
</html>