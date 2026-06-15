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

        <h3>1. Detail Penerima & Cabang</h3>
        <label>Nama Penerima:</label><br>
        <input type="text" name="recipient_name" required placeholder="Nama Lengkap"><br><br>

        <label>Nomor Telepon:</label><br>
        <input type="text" name="recipient_phone" required placeholder="Contoh: 0812345678"><br><br>

        <label>Pilih Cabang Outlet (Merchant):</label><br>
        <select name="merchant_id" required>
            <option value="">-- Pilih Cabang --</option>
            @foreach(\App\Models\Merchant::all() as $merchant)
                <option value="{{ $merchant->id }}">{{ $merchant->name }} - {{ $merchant->location }}</option>
            @endforeach
        </select>

        <h3>2. Metode Konsumsi</h3>
        <select name="order_type" required>
            <option value="dine_in">Dine In (Makan di Tempat)</option>
            <option value="take_away">Take Away (Bawa Pulang)</option>
        </select>

        <h3>3. Metode Pembayaran</h3>
        <select name="payment_method" id="payment_method" onchange="toggleBankSelection()" required>
            <option value="qris">QRIS</option>
            <option value="cash">Cash (Bayar di Kasir)</option>
            <option value="transfer_bank">Transfer Bank</option>
        </select>

        <div id="bank_options" style="display: none; margin-top: 10px;">
            <label>Pilih Bank Transfer:</label>
            <select name="bank_name">
                <option value="BCA">BCA</option>
                <option value="BNI">BNI</option>
                <option value="Mandiri">Mandiri</option>
                <option value="Seabank">Seabank</option>
            </select>
        </div>

        <h3>4. Pilih Menu (Item Pesanan)</h3>
        <div id="menu-container">
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <label><strong>Pilih Item 1:</strong></label><br>
                <select name="items[0][reward_id]" required>
                    <option value="">-- Pilih Menu --</option>
                    @foreach(\App\Models\Reward::all() as $reward)
                        <option value="{{ $reward->id }}">{{ $reward->name }} - Rp {{ number_format($reward->price_points, 0, ',', '.') }}</option>
                    @endforeach
                </select>
                <br><br>

                <label>Ukuran Cup:</label>
                <select name="items[0][size]" required>
                    <option value="reguler">Reguler</option>
                    <option value="large">Large (+Rp 5.000)</option>
                </select>

                <label>Ice Level:</label>
                <select name="items[0][ice_level]" required>
                    <option value="normal">Normal Ice</option>
                    <option value="less">Less Ice</option>
                </select>

                <label>Sugar Level:</label>
                <select name="items[0][sugar_level]" required>
                    <option value="normal">Normal Sugar</option>
                    <option value="less">Less Sugar</option>
                </select>
            </div>
        </div>

        <button type="button" id="btn-tambah-menu" style="margin-bottom: 20px;">+ Tambah Menu Lain</button>

        <br><hr>
        <button type="submit" style="padding: 10px 20px; background-color: green; color: white; font-weight: bold; cursor: pointer;">KIRIM PESANAN & CHECKOUT</button>
    </form>

    <script>
        let itemIndex = 1;

        // Fungsi duplikasi / tambah menu otomatis saat dipencet
        document.getElementById('btn-tambah-menu').addEventListener('click', function() {
            let container = document.getElementById('menu-container');
            let firstItem = container.children[0];
            let cloneItem = firstItem.cloneNode(true);

            // Ganti angka label judul item (Item 1 menjadi Item 2, dst)
            cloneItem.querySelector('strong').innerText = 'Pilih Item ' + (itemIndex + 1) + ' (Opsional):';

            // Bersihkan value select menu utama agar tidak ikut ter-copy pilihannya
            cloneItem.querySelector('select').value = "";

            // Update index penamaan array items agar terbaca terpisah di Controller
            cloneItem.querySelectorAll('select').forEach(select => {
                select.name = select.name.replace(/\[\d+\]/, '[' + itemIndex + ']');
                // Hilangkan required khusus untuk item tambahan agar opsional
                if (select.name.includes('[reward_id]')) {
                    select.required = false;
                }
            });

            container.appendChild(cloneItem);
            itemIndex++;
        });

        // Fungsi kondisional dropdown Bank
        function toggleBankSelection() {
            let method = document.getElementById('payment_method').value;
            let bankDiv = document.getElementById('bank_options');
            if (method === 'transfer_bank') {
                bankDiv.style.display = 'block';
            } else {
                bankDiv.style.display = 'none';
            }
        }
    </script>
</body>
</html>