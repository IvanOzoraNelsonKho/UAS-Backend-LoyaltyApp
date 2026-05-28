<html>
<head>
    <title>Edit Data Redemption</title>
</head>
<body>
    <h1>Edit Data Penukaran</h1>

    <form action="{{ route('redemptions.update', $redemption->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="user_id">ID User:</label><br>
        <input type="number" id="user_id" name="user_id" value="{{ $redemption->user_id }}" required><br><br>

        <label for="reward_id">ID Reward (Voucher):</label><br>
        <input type="number" id="reward_id" name="reward_id" value="{{ $redemption->reward_id }}" required><br><br>

        <label for="merchant_id">ID Merchant:</label><br>
        <input type="number" id="merchant_id" name="merchant_id" value="{{ $redemption->merchant_id }}" required><br><br>

        <label for="status">Status Penukaran:</label><br>
        <select id="status" name="status" required>
            <option value="pending" {{ $redemption->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="success" {{ $redemption->status == 'success' ? 'selected' : '' }}>Success</option>
        </select><br><br>

        <button type="submit">Update Data</button>
    </form>

    <br>
    <a href="{{ route('redemptions.index') }}">Kembali ke Daftar Penukaran</a>
</body>
</html>