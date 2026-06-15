<!DOCTYPE html>
<html>
<head>
    <title>Klaim Kode Referral - Chatime Loyalty App</title>
</head>
<body>
    <h1>Klaim Kode Referral Teman</h1>
    <a href="{{ route('transactions.index') }}">⬅️ Kembali ke Dashboard</a>
    <hr>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <p style="color: green; font-weight: bold;">✅ {{ session('success') }}</p>
    @endif

    {{-- Notifikasi Gagal / Error Aturan Khusus dari Controller --}}
    @if(session('error'))
        <p style="color: red; font-weight: bold;">❌ {{ session('error') }}</p>
    @endif

    <p>Masukkan kode referral yang kamu dapatkan dari temanmu untuk mendapatkan bonus saldo poin loyalty awal.</p>

    <form action="{{ route('referrals.claim') }}" method="POST">
        @csrf
        
        <label for="referrer_code"><strong>Kode Referral Teman:</strong></label><br>
        <input type="text" 
               name="referrer_code" 
               id="referrer_code" 
               placeholder="Contoh: K7X9WZ" 
               value="{{ old('referrer_code') }}" 
               required>

        {{-- Pesan Error Validasi Otomatis dari Laravel jika kode tidak terdaftar --}}
        @error('referrer_code')
            <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
        @enderror

        <br><br>
        <button type="submit" style="padding: 5px 15px; background-color: blue; color: white; cursor: pointer;">Klaim Poin Bonus</button>
    </form>
</body>
</html>