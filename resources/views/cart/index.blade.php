<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Penukaran Poin</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">

    <div style="max-width: 800px; background: #ffffff; margin: 40px auto; padding: 30px; border-radius: 20px; border: 2px solid #031344; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        
        <h2 style="text-align: center; color: #031344;">🛒 Konfirmasi Penukaran Poin</h2>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="{{ url('/rewards') }}">
                <button style="padding: 8px 15px; cursor: pointer; border-radius: 5px; border: 1px solid #ccc;">⬅️ Balik ke Katalog</button>
            </a>
        </div>
        
        <hr style="border: 1px solid #eee; margin-bottom: 20px;">

        @if(count($cart_items) > 0)
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: #031344; margin-bottom: 20px;">
                <tr style="background-color: #8ca7d6;">
                    <th>Menu Minuman</th>
                    <th style="text-align: center;">Harga Satuan</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: right;">Subtotal Poin</th>
                </tr>
                @foreach($cart_items as $item)
                <tr>
                    <td>{{ $item->nama_minuman }}</td>
                    <td style="text-align: center;">{{ $item->poin_satuan }} Pts</td>
                    <td style="text-align: center;">{{ $item->qty }}x</td>
                    <td style="text-align: right;"><b>{{ $item->subtotal }} Pts</b></td>
                </tr>
                @endforeach
            </table>

            <div style="background-color: #f8f9fa; padding: 20px; border: 1px solid #ddd; border-radius: 15px; margin-bottom: 20px;">
                <h3 style="margin-top: 0; color: #333;">Ringkasan Saldo:</h3>
                <p>Saldo Poin Lu Saat Ini: <b style="color: blue;">{{ number_format($user->point_balance, 0, ',', '.') }} Pts</b></p>
                <p>Total Poin Dibutuhkan: <b style="color: red;">{{ number_format($total_poin, 0, ',', '.') }} Pts</b></p>
                <hr style="border: 1px solid #ddd; margin: 15px 0;">
                
                @if($user->point_balance >= $total_poin)
                    <p style="color: green; font-weight: bold; text-align: center;">✅ Asik! Saldo poin lu cukup buat nuker ini semua.</p>
                    <form action="{{ url('/cart/checkout') }}" method="POST" style="text-align: center;">
                        @csrf
                        <button type="submit" style="padding: 12px 24px; background-color: #28a745; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px rgba(40,167,69,0.3);">
                            🚀 KONFIRMASI & POTONG POIN SEKARANG!
                        </button>
                    </form>
                @else
                    <p style="color: red; font-weight: bold; text-align: center;">❌ Yaelah obos! Poin lu miskin, kurang {{ number_format($total_poin - $user->point_balance, 0, ',', '.') }} Pts lagi!</p>
                    <div style="text-align: center;">
                        <button disabled style="padding: 12px 24px; background-color: #ccc; color: #666; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: not-allowed;">
                            KAGA BISA CHECKOUT
                        </button>
                    </div>
                @endif
            </div>
        @else
            <p style="text-align: center; color: #666; font-style: italic; margin: 40px 0;">Keranjang lu masih kosong melompong obos. Mending lu jajan dulu gih.</p>
        @endif
    </div>

</body>
</html>