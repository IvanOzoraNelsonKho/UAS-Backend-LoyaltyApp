<!DOCTYPE html>
<html>
<head>
    <title>Klaim Nota Baru</title>
</head>
<body>
    <div>
        <h2>Klaim Poin Baru</h2>
        <p>Masukkan total nominal yang tertera pada struk belanja dessert kamu untuk ditukarkan menjadi poin reward.</p>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label>Nomor Nota / Invoice: </label>
                <input type="text" name="invoice_number" placeholder="Contoh: INV-20260528-001" required>

                <!-- Nampilin pesan error jika nomor nota duplikat -->
                @error('invoice_number')
                    <small style="color: red; display: block; margin-top: 5px;">{{ $message }}</small>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold; display: block; margin-bottom: 8px;">Total Belanja (Rupiah):</label>
                <input type="number" name="total_amount" placeholder="Contoh: 50000" min="0" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" required>
                <small style="color: #6c757d; display: block; margin-top: 5px;">*Setiap kelipatan Rp 10.000 otomatis jadi 10 Poin reward.</small>
            </div>

            <button type="submit" style="width: 100%; background: #28a745; color: white; border: none; padding: 12px; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 15px;">Verifikasi & Klaim Poin</button>
        </form>

        <br>
        <div style="text-align: center;">
            <a href="{{ route('transactions.index') }}" style="color: #007bff; text-decoration: none; font-size: 14px;">← Kembali ke Riwayat Saya</a>
        </div>
    </div>
</body>
</html>