<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
</head>
<body style = "background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif">
    <h1 style = "border-bottom: 2px solid #333; padding-bottom: 5px; text-align: center; font: bold 35px Georgia ;">Order History</h1>
    <div style="text-align:center">
    <a href="{{ route('users.show', auth()->id()) }}"><button style = "padding: 10px">⬅️ Back to Profile</button></a> 
    <a href="{{ route('transactions.create') }}"><button style = "padding: 10px"> + Online Order</button></a> 
    <a href="{{ route('point_histories.index') }}"><button style = "padding: 10px">💎 Point History</button></a>
    </div>
    <hr>

    @if(session('success'))
        <p style="color: green; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <div style= "border : 2px solid #031344; padding: 20px; background-color: #f9f9f9; border-radius: 40px; margin: 0 auto">
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black">
        <thead style= "text-align:center">
            <tr style="background-color: #8ca7d6">
                <div style= "font: 15px bold Georgia">
                <th>Order ID</th>
                <th>Outlet</th>
                <th>Menu Items</th>
                <th>Total Paid</th>
                <th>Points Earned</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Order Time</th>
                </div>
            </tr>
        </thead>

        <tbody>
            @foreach($transactions as $tx)
            <tr style= "">
                <td><strong>{{ $tx->order_id }}</strong></td>
                <td>{{ $tx->merchant->name }}</td>
                <td>
                    <ul style="padding-left: 15px; margin: 0;">
                        @foreach($tx->details as $detail)
                            <li style="margin-bottom: 5px;">
                                <strong>{{ $detail->reward->name }}</strong> ({{ $detail->quantity }}x)<br>
                                <small style="color: #555; display: inline-block; margin-top: 2px;">
                                    Size: {{ ucfirst($detail->size) }} | 
                                    Ice: {{ ucfirst($detail->ice_level) }} Ice | 
                                    Sugar: {{ ucfirst($detail->sugar_level) }} Sugar
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>Rp {{ number_format($tx->total_price, 0, ',', '.') }}</td>
                <td><strong style="color: blue;">+{{ $tx->details->count() * 20 }} Poin</strong></td>
                <td>{{ strtoupper($tx->payment_method) }}</td>
                <td>
                    <span style="background-color: #ffeeba; color: #856404; padding: 4px 8px; border-radius: 4px; font-weight: bold; display: inline-block;">
                        ⏳ {{ $tx->status }}
                    </span>
                </td>
                <td>{{ $tx->created_at->format('d M Y, H:i') }} WIB</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>