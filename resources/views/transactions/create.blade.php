<!DOCTYPE html>
<html>
<head>
    <title>Pesan Online - Chatime Loyalty App</title>
</head>
<body>
    <h1>Buat Pesanan Baru / Checkout</h1>
    <a href="{{ route('users.show', auth()->id()) }}"><button>⬅️ Kembali ke Profile</button></a>  
    <a href="{{ route('transactions.index') }}"><button>⬅️ Kembali ke Riwayat Pemesanan</button></a>
    <hr>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <h3>1. Detail Penerima & Cabang</h3>
        <label>Nama Penerima:</label><br>
        <input type="text" name="recipient_name" value="{{ request('recipient_name') }}" required placeholder="Nama Lengkap"><br><br>

        <label>Nomor Telepon:</label><br>
        <input type="text" name="recipient_phone" value="{{ request('recipient_phone') }}" required placeholder="Contoh: 0812345678"><br><br>

        <label>Pilih Cabang Outlet (Merchant):</label><br>
        <select name="merchant_id" required>
            <option value="">-- Pilih Cabang --</option>
            @foreach(\App\Models\Merchant::all() as $merchant)
                <option value="{{ $merchant->id }}" {{ request('merchant_id') == $merchant->id ? 'selected' : '' }}>
                    {{ $merchant->name }} - {{ $merchant->location }}
                </option>
            @endforeach
        </select>

        <h3>2. Metode Konsumsi</h3>
        <select name="order_type" required>
            <option value="dine_in" {{ request('order_type') == 'dine_in' ? 'selected' : '' }}>Dine In (Makan di Tempat)</option>
            <option value="take_away" {{ request('order_type') == 'take_away' ? 'selected' : '' }}>Take Away (Bawa Pulang)</option>
        </select>

        <h3>3. Metode Pembayaran</h3>
        <select name="payment_method" onchange="this.form.action='{{ route('transactions.create') }}'; this.form.method='GET'; this.form.submit();" required>
            <option value="qris" {{ request('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
            <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash (Bayar di Kasir)</option>
            <option value="transfer_bank" {{ request('payment_method') == 'transfer_bank' ? 'selected' : '' }}>Transfer Bank</option>
        </select>

        @if(request('payment_method') === 'transfer_bank')
            <div id="bank_options" style="margin-top: 10px;">
                <label>Pilih Bank Transfer:</label>
                <select name="bank_name">
                    <option value="BCA" {{ request('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="BNI" {{ request('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                    <option value="Mandiri" {{ request('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                    <option value="Seabank" {{ request('bank_name') == 'Seabank' ? 'selected' : '' }}>Seabank</option>
                </select>
            </div>
        @endif

        <h3>4. Pilih Menu (Item Pesanan)</h3>
        <div id="menu-container">
            @php
                $jumlahItem = max(1, intval(request('jumlah_item', 1)));
            @endphp

            @for($i = 0; $i < $jumlahItem; $i++)
                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                    <label><strong>Pilih Item {{ $i + 1 }}{{ $i > 0 ? ' (Opsional):' : ':' }}</strong></label><br>
                    <select name="items[{{ $i }}][reward_id]" {{ $i == 0 ? 'required' : '' }}>
                        <option value="">-- Pilih Menu --</option>
                        @foreach(\App\Models\Reward::all() as $reward)
                            <option value="{{ $reward->id }}">
                                {{ $reward->name }} - Rp {{ number_format($reward->price_points, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    <br><br>

                    <label>Ukuran Cup:</label>
                    <select name="items[{{ $i }}][size]" required>
                        <option value="reguler">Reguler</option>
                        <option value="large">Large (+50 poin)</option>
                    </select>

                    <label>Ice Level:</label>
                    <select name="items[{{ $i }}][ice_level]" required>
                        <option value="normal">Normal Ice</option>
                        <option value="less">Less Ice</option>
                    </select>

                    <label>Sugar Level:</label>
                    <select name="items[{{ $i }}][sugar_level]" required>
                        <option value="normal">Normal Sugar</option>
                        <option value="less">Less Sugar</option>
                    </select>
                </div>
            @endfor
        </div>

        <button type="submit" formaction="{{ route('transactions.create') }}" formmethod="GET" name="jumlah_item" value="{{ $jumlahItem + 1 }}" formnovalidate style="margin-bottom: 20px;">
            + Tambah Menu Lain
        </button>

        <br><hr>
        <button type="submit" style="padding: 10px 20px; background-color: green; color: white; font-weight: bold; cursor: pointer;">
            KIRIM PESANAN & CHECKOUT
        </button>
    </form>
</body>
</html>