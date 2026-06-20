<!DOCTYPE html>
<html>
<head>
    <title>Point History - Chatime Loyalty App</title>
</head>
<body style = "background-color: rgb(192, 219, 247); font-family: sans-serif, Georgia">
    <h1 style= "text-align: center; font: bold 35px Georgia">Point Transaction History</h1>
    <div style= "text-align:center">
    <a href="{{ route('users.show', auth()->id()) }}"><button>⬅️ Back to Profile</button></a>  
    <a href="{{ route('transactions.index') }}"><button>⬅️ Back to Order History</button></a>
    </div>
    <hr>

    <div style= "border : 2px solid #031344; padding: 20px; background-color: #f9f9f9; border-radius: 40px; margin: 0 auto; max-width: 1000px;">
    {{-- Ringkasan Total Saldo Poin --}}
    <h2 style= "text-align:center">Your Current Balance: <span style="color: blue;">{{ number_format(auth()->user()->point_balance) }} Point</span></h2>
    <hr>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; border-collapse: collapse; border-color: black">
        <thead>
            <tr style="background-color: #8ca7d6; text-align:center">
                <th>Date & Time</th>
                <th>Activity Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pointHistories as $history)
                <tr>
                    <td>{{ $history->created_at->format('d M Y, H:i') }} WIB</td>
                    <td>{{ $history->description }}</td>
                    <td style="font-weight: bold; color: {{ $history->type === 'in' ? 'green' : 'red' }};">
                        {{ $history->type === 'in' ? '+' : '-' }}{{ number_format($history->amount) }} Poin
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: gray; font-style: italic;">
                        No point transactions found in your account history.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</body>
</html>