<html>
<head>
    <title>Tambah Data Redemption</title>
</head>
<body>
    <h1>Tambah Data Penukaran</h1>

    <form action="{{ route('redemptions.store') }}" method="POST">
        @csrf
        
        <label for="user_id">ID User:</label><br>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="reward_id">ID Reward (Voucher):</label><br>
        <input type="number" id="reward_id" name="reward_id" required><br><br>

        <label for="merchant_id">ID Merchant:</label><br>
        <input type="number" id="merchant_id" name="merchant_id" required><br><br>

        <button type="submit">Simpan Data</button>
    </form>

    <br>
    <a href="{{ route('redemptions.index') }}">Kembali ke Daftar Penukaran</a>
</body>
</html>