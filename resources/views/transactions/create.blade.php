<!DOCTYPE html>
<html>
<head>
    <title>Online Order Form - Chatime Loyalty App</title>
</head>
<body style="font-family: Arial, sans-serif, Georgia; margin: 20px; background-color: rgb(192, 219, 247)">
    <div style ="border : 2px solid #031344; padding: 20px; background-color: #fff; border-radius: 40px; margin: 0 auto; max-width: 900px;">
    <h1 style="color: #333; border-bottom: 2px solid #333; padding-bottom: 10px; text-align: center; font: bold 35px Georgia ;">Online Order</h1>
    @if(session('error'))
        <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red; font-weight: bold; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style= "text-align: center;">
        <a href="{{ route('users.show', auth()->id()) }}"><button class="btn" style="color: white; padding: 10px; background-color: #6c757d;">⬅️ Back to Profile</button></a> 
        <a href="{{ route('transactions.index') }}"><button style = "padding: 10px" >⬅️ Back to Order History</button></a>
    </div>
    <hr>

    @if(session('error'))
        <p style="color: red; font-weight: bold;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <h3>1. Recipient Detail & Outlet</h3>
        <label>Name:</label><br>
        <input class = "form-option" type="text" name="recipient_name" value="{{ request('recipient_name') }}" required placeholder="Enter your name"><br><br>

        <label>Phone Numer:</label><br>
        <input class = "form-option" type="text" name="recipient_phone" value="{{ request('recipient_phone') }}" required placeholder="Enter your phone number"><br><br>

        <label>Choose Outlet (Merchant):</label><br>
        <select class = "form-option" name="merchant_id" required>
            <option value="">-- Choose Outlet --</option>
            @foreach(\App\Models\Merchant::all() as $merchant)
                <option value="{{ $merchant->id }}" {{ request('merchant_id') == $merchant->id ? 'selected' : '' }}>
                    {{ $merchant->name }} - {{ $merchant->location }}
                </option>
            @endforeach
        </select>

        <h3>2. Order Type</h3>
        <select class = "form-option" name="order_type" required>
            <option value="">-- Dine In or Take Away --</option>
            <option value="dine_in" {{ request('order_type') == 'dine_in' ? 'selected' : '' }}>Dine In</option>
            <option value="take_away" {{ request('order_type') == 'take_away' ? 'selected' : '' }}>Take Away</option>
        </select>

        <h3>3. Payment Method</h3>
        <select class = "form-option" name="payment_method" onchange="this.form.action='{{ route('transactions.create') }}'; this.form.method='GET'; this.form.submit();" required>
            <option value="">-- Choose Payment Method --</option>
            <option value="qris" {{ request('payment_method') == 'qris' ? 'selected' : '' }}>QRIS</option>
            <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
            <option value="transfer_bank" {{ request('payment_method') == 'transfer_bank' ? 'selected' : '' }}>Transfer Bank</option>
        </select>

        @if(request('payment_method') === 'transfer_bank')
            <div id="bank_options" style="margin-top: 10px;">
                <label>Virtual Account Transfer:</label>
                <select class = "form-option" name="bank_name">
                    <option value="BCA" {{ request('bank_name') == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="BNI" {{ request('bank_name') == 'BNI' ? 'selected' : '' }}>BNI</option>
                    <option value="Mandiri" {{ request('bank_name') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                    <option value="Seabank" {{ request('bank_name') == 'Seabank' ? 'selected' : '' }}>Seabank</option>
                </select>
            </div>
        @endif

        <h4>🎁  Apply Voucher Promo (Optional)</h3>
        <select class = "form-option" name="voucher_id">
            <option value="">-- Choose Voucher --</option>
            @foreach(\App\Models\Voucher::where('is_used', false)->get() as $voucher)
                <option value="{{ $voucher->id }}" {{ request('voucher_id') == $voucher->id ? 'selected' : '' }}>
                    {{ $voucher->code }} - Potongan Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
                </option>
            @endforeach
        </select>

        <h3>4. Select Menu (Order Items)</h3>
        <div id="menu-container">
            @php
                $jumlahItem = max(1, intval(request('jumlah_item', 1)));
            @endphp

            @for($i = 0; $i < $jumlahItem; $i++)
                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                    <label><strong>Select Item {{ $i + 1 }}{{ $i > 0 ? ' (Opsional):' : ':' }}</strong></label><br>
                    
                    <!-- harga disamain semua RP 30.000 -->
                    <select class = "form-option" name="items[{{ $i }}][reward_id]" {{ $i == 0 ? 'required' : '' }}>
                        <option value="">-- Choose Menu --</option>
                        @foreach(\App\Models\Reward::all() as $reward)
                            <option value="{{ $reward->id }}">
                                {{ $reward->name }} - Rp 30.000
                            </option>
                        @endforeach
                    </select>
                    <br><br>

                    <!-- update ukuran cup nambah RP 5.000 -->
                    <label>Cup Size:</label><br>
                    <select class = "form-option" name="items[{{ $i }}][size]" required>
                        <option value="">-- Choose Cup Size --</option>
                        <option value="reguler">Reguler</option>
                        <option value="large">Large (+Rp 5.000)</option>
                    </select><br>

                    <label>Ice Level:</label><br>
                    <select class = "form-option" name="items[{{ $i }}][ice_level]" required>
                        <option value="">-- Choose Ice Level --</option>
                        <option value="normal">Normal Ice</option>
                        <option value="less">Less Ice</option>
                    </select><br>

                    <label>Sugar Level:</label><br>
                    <select class = "form-option" name="items[{{ $i }}][sugar_level]" required>
                        <option value="">-- Choose Sugar Level --</option>
                        <option value="normal">Normal Sugar</option>
                        <option value="less">Less Sugar</option>
                    </select><br>
                </div>
            @endfor
        </div>

        <button type="submit" formaction="{{ route('transactions.create') }}" formmethod="GET" name="jumlah_item" value="{{ $jumlahItem + 1 }}" formnovalidate style="margin-bottom: 20px;">
            + Add More Item
        </button>

        <br><hr>
        <button type="submit" style="padding: 10px 20px; background-color: green; color: white; font-weight: bold; cursor: pointer;">
            PLACE ORDER & CHECKOUT
        </button>
    </form>
    </div>

    <style>
    .form-option {
        width: 90%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        box-shadow: 3px 3px 3px rgb(190, 227, 243);
    }    
    </style>
</body>
</html>