<!DOCTYPE html>
<html>
<head>
    <title>Pesan Online - Chatime Loyalty App</title>
</head>
<body>
    <h1>Buat Pesanan Baru / Checkout</h1>
    <a href="{{ route('transactions.index') }}">⬅️ Kembali ke Riwayat</a>
    <hr>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <h3>1. Pilih Akun Pelanggan</h3>
        <select name="user_id" required>
            <option value=""> Pilih User </option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} (Poin Saat Ini: {{ $user->point_balance }})</option>
            @endforeach
        </select>

        <h3>2. Pilih Cabang Outlet</h3>
        <select name="merchant_id" required>
            <option value=""> Pilih Cabang </option>
            @foreach($merchants as $merchant)
                <option value="{{ $merchant->id }}">{{ $merchant->name }} - {{ $merchant->location }}</option>
            @endforeach
        </select>

        <h3>3. Metode Pembayaran</h3>
        <input type="radio" name="payment_method" value="cash" checked> Tunai (Cash) <br>
        <input type="radio" name="payment_method" value="e-wallet"> Saldo E-Wallet / Digital Wallet

        <h3>4. Pilih Menu (Item Pesanan)</h3>
        <div>
            <label>Pilih Item 1:</label>
            <select name="items[0][reward_id]" required>
                <option value=""> Pilih Menu </option>
                @foreach($rewards as $reward)
                    <option value="{{ $reward->id }}">{{ $reward->name }} - Rp {{ number_format($tx->total_amount, 0, ',', '.') }} (Stok: {{ $reward->stock }})</option>
                @endforeach
            </select>
            <input type="number" name="items[0][quantity]" value="1" min="1" placeholder="Qty" required style="width: 50px;">
        </div>
        <br>
        <div>
            <label>Pilih Item 2 (Opsional):</label>
            <select name="items[1][reward_id]">
                <option value="">-- Pilih Menu --</option>
                @foreach($rewards as $reward)
                    <option value="{{ $reward->id }}">{{ $reward->name }} - Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</option>
                @endforeach
            </select>
            <input type="number" name="items[1][quantity]" value="1" min="1" placeholder="Qty" style="width: 50px;">
        </div>

        <br><hr>
        <button type="submit" style="padding: 10px 20px; background-color: green; color: white;">KIRIM PESANAN & CHECKOUT</button>
    </form>
</body>
</html>