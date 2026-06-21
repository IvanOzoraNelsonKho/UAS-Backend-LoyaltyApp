<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif">
    <div style="max-width: 750px; background: #ffffff; margin: 20px auto; padding: 35px; border-radius: 16px; border : 2px solid #031344">
        <h1 style="text-align: center; font: bold 35px Georgia; margin-top: 0; margin-bottom: 25px; color: #000000;">PROFILE</h1>

        <div style="max-width: 750px; background: linear-gradient(135deg, #1e2c86 20%, #4d63f0 50%) ; margin: 20px auto; padding: 35px; border-radius: 16px;">

            <h3>Membership Status:</h3>
        
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-top: 6px; margin-bottom: 20px;">
                <span style="display: inline-block;
                        background: #fff;
                        color: #800303;
                        padding: 6px 14px;
                        border-radius: 8px;
                        font-weight: bold;
                        font-size: 14px;
                        box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        {{ $user->tier ? $user->tier->name : 'Bronze Member' }}
                </span>        
                <span style="font-size: 13px;
                    background: rgba(255, 255, 255, 0.2);
                    padding: 6px 12px;
                    border-radius: 20px;
                    font-weight: bold;
                    color: #fff;
                    letter-spacing: 0.5px">ID Member: #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            </div>

            <h3>Customer Name:</h3>
            <h2 style="font-size: 24px; font-weight: 700; font-family: Georgia; color: #fff; margin-top: 4px; margin-bottom: 20px;">{{ $user->name }}</h2>
            
            <h3>Available Balance:</h3>
            <p style="margin-top: 6px;
                    margin-bottom: 0;
                    background: rgba(255, 255, 255, 0.12);
                    padding: 10px 16px;
                    border-radius: 8px;
                    display: inline-flex;
                    align-items: center;
                    color: #fff;
                    font-weight: bold;">
                    💰 {{ number_format($user->point_balance, 0, ',', '.') }} Pts
            </p>
        </div>
        
        <div style="max-width: 750px; margin: 0 auto; padding: 0 35px;">
            <h3 style="color: #333; font-size: 14px; padding-left: 8px; margin-top: 25px;">Informasi Detail Akun</h3>
            <ul>
                <li><b>Email Aktif:</b> {{ $user->email }}</li>
                <li><b>Tanggal Bergabung:</b> {{ $user->created_at ? $user->created_at->format('d M Y') : date('d M Y') }}</li>
                <li><b>Kode Referral Anda:</b> <span style="background-color: #ffffcc; padding: 2px 6px; border: 1px dashed #ccc; font-weight: bold; color: purple;">{{ $user->referral_code ?? 'Tidak Ada (Admin)' }}</span></li>
            </ul>

            <br>
            <a href="{{ route('missions.index') }}"><button style="padding: 8px 12px; cursor: pointer;">🎮 Masuk ke Halaman Misi</button></a>
            <a href="{{ route('transactions.create') }}"><button style="padding: 8px 12px; cursor: pointer;">🛒 Pesan Online</button></a>
            <a href="{{ url('/rewards') }}"><button style="padding: 8px 12px; cursor: pointer;">🎁 Tukar Poin (Katalog)</button></a>
            <a href="{{ url('/cart') }}"><button style="padding: 8px 12px; cursor: pointer;">🛒 Keranjang Lu</button></a>
            <a href="{{ route('point_histories.index') }}"><button style="padding: 8px 12px; cursor: pointer;">🪙 History Point</button></a>
            <a href="{{ route('transactions.index') }}"><button style="padding: 8px 12px; cursor: pointer;">📜 Riwayat Transaksi</button></a>
            <a href="{{ route('referral.claim') }}"><button style="padding: 8px 12px; cursor: pointer;">🎁 Klaim Kode Referral</button></a>
            <a href="{{ url('/offers') }}"><button style="padding: 8px 12px; cursor: pointer;">🎟️ Daftar Voucher</button></a>
            <a href="{{ url('/outlets') }}"><button style="padding: 8px 12px; cursor: pointer;">🏪 Lokasi Outlet</button></a>
            <br><br>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="color: red; cursor: pointer; font-weight: bold;">🚪 Keluar (Logout)</button>
            </form>
        </div> 
    </div>
</body>

<style>
    h3 { 
        font-size: 12px; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
        color: rgba(255, 255, 255, 0.75);
        margin-top: 15px;
        margin-bottom: 0;
    }
</style>
</html>