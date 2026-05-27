<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h1>Input Transaksi Baru</h1>
    <!-- route nya buat balik ke page index atau daftar transaksi -->
    <a href="{{ route('transactions.index') }}">← Kembali ke Daftar Transaksi</a>
    <br><br>

    <!-- ini buat form input transaksi baru -->
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        
        <label><strong>Pilih Pelanggan:</strong></label><br>
        <select name="user_id" required>
            <option value=""> Pilih User </option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} (Sisa Poin: {{ $user->point_balance ?? 0 }})</option>
            @endforeach
        </select>
        <br><br>

        <label><strong>Total Belanja (Rupiah):</strong></label><br>
        <input type="number" name="total_amount" placeholder="Contoh: 50000" min="0" required>
        <br><br>

        <button type="submit">Simpan Transaksi</button>
    </form>
</body>
</html>