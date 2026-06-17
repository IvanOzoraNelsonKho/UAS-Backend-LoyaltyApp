<html>
<head>
    <title>Edit Data Redemption</title>
</head>
<body>
    <h1>Edit Data Penukaran</h1>

    <form action="{{ route('redemptions.update', $redemption->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="user_id">Nama User:</label><br>
        <select id="user_id" name="user_id" required>
            <option value="">-- Pilih User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $redemption->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select><br><br>

        <label for="reward_id">Reward:</label><br>
        <select id="reward_id" name="reward_id" required>
            <option value="">-- Pilih Reward --</option>
            @foreach($rewards as $reward)
                <option value="{{ $reward->id }}" {{ $redemption->reward_id == $reward->id ? 'selected' : '' }}>{{ $reward->name }}</option>
            @endforeach
        </select><br><br>

        <label for="merchant_id">Outlet:</label><br>
        <select id="merchant_id" name="merchant_id" required>
            <option value="">-- Pilih Outlet --</option>
            @foreach($merchants as $merchant)
                <option value="{{ $merchant->id }}" {{ $redemption->merchant_id == $merchant->id ? 'selected' : '' }}>{{ $merchant->name }}</option>
            @endforeach
        </select><br><br>

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