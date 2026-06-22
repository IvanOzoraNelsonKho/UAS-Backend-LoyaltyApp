<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
</head>
<body style = "background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding-bottom: 50px;">
    <h1 style = "border-bottom: 2px solid #333; padding-bottom: 5px; text-align: center; font: bold 35px Georgia ;">Order History</h1>
    <div style="text-align:center">
        <!-- TOMBOL BACK UDAH ADA DARI AWAL BANGSAT -->
        <a href="{{ url('/profile') }}"><button style = "padding: 10px; cursor: pointer; background-color: #6c757d; color: white; border: none; border-radius: 5px;">⬅️ Back to Profile</button></a> 
        <a href="{{ route('transactions.create') }}"><button style = "padding: 10px; cursor: pointer;">🛒 + Online Order</button></a> 
        <a href="{{ url('/rewards') }}"><button style = "padding: 10px; cursor: pointer;">🎁 Tukar Poin Lagi</button></a> 
        <a href="{{ route('point_histories.index') }}"><button style = "padding: 10px; cursor: pointer;">💎 Point History</button></a>
    </div>
    <hr>

    @if(session('success'))
        <div style="max-width: 900px; margin: 10px auto; padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; text-align: center; font-weight: bold;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div style="max-width: 95%; border : 2px solid #031344; padding: 20px; background-color: #f9f9f9; border-radius: 40px; margin: 20px auto">
        <h2 style="margin-top: 0; color: #031344;">💸 Riwayat Pembelian (Dapat Poin)</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black; background-color: white;">
            <thead style= "text-align:center; background-color: #8ca7d6;">
                <tr>
                    <th>Order ID</th>
                    <th>Outlet</th>
                    <th>Menu Items</th>
                    <th>Total Paid</th>
                    <th>Points Earned</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Order Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $tx)
                <tr>
                    <td style="text-align:center;"><strong>{{ $tx->order_id }}</strong></td>
                    <td>{{ $tx->merchant->name ?? 'Pusat' }}</td>
                    <td>
                        <ul style="padding-left: 15px; margin: 0;">
                            @foreach($tx->details as $detail)
                                <li style="margin-bottom: 5px;">
                                    <strong>{{ $detail->reward->name ?? 'Menu' }}</strong> ({{ $detail->quantity }}x)<br>
                                    <small style="color: #555;">Size: {{ ucfirst($detail->size ?? 'Normal') }} | Ice: {{ ucfirst($detail->ice_level ?? 'Normal') }} | Sugar: {{ ucfirst($detail->sugar_level ?? 'Normal') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td style="text-align:right;">Rp {{ number_format($tx->total_price, 0, ',', '.') }}</td>
                    <td style="text-align:center;"><strong style="color: blue;">+{{ $tx->points_earned ?? ($tx->details->count() * 20) }} Poin</strong></td>
                    <td style="text-align:center;">{{ strtoupper($tx->payment_method ?? 'CASH') }}</td>
                    <td style="text-align:center;">
                        <span style="background-color: #ffeeba; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold;">
                            ⏳ {{ $tx->status ?? 'Success' }}
                        </span>
                    </td>
                    <td style="text-align:center;">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #666;">Belum ada riwayat pembelian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="max-width: 95%; border : 2px solid #800303; padding: 20px; background-color: #fff5f5; border-radius: 40px; margin: 20px auto">
        <h2 style="margin-top: 0; color: #800303;">🎁 Riwayat Penukaran Poin (Minuman Gratis)</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black; background-color: white;">
            <thead style= "text-align:center; background-color: #f5baba;">
                <tr>
                    <th>ID Penukaran</th>
                    <th>Minuman yang Ditukar</th>
                    <th>Poin Terpakai</th>
                    <th>Status</th>
                    <th>Waktu Penukaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse($redemptions as $rdm)
                <tr>
                    <td style="text-align:center;"><strong>RDM-{{ str_pad($rdm->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                    <td>
                        <!-- BARBAR TAPI JALAN -->
                        <strong>{{ \App\Models\Reward::find($rdm->reward_id)->name ?? 'Minuman Tidak Diketahui' }}</strong>
                    </td>
                    <td style="text-align:center;"><strong style="color: red;">-{{ $rdm->points_spent ?? \App\Models\Reward::find($rdm->reward_id)->points_required }} Pts</strong></td>
                    <td style="text-align:center;">
                        @if($rdm->status == 'success')
                            <span style="background-color: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-weight: bold;">✅ Sukses</span>
                        @else
                            <span style="background-color: #ffeeba; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold;">⏳ {{ ucfirst($rdm->status) }}</span>
                        @endif
                    </td>
                    <td style="text-align:center;">{{ $rdm->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #666;">Belum ada riwayat penukaran poin.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>