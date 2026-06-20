<!DOCTYPE html>
<html>
<head>
    <title>Claim Referral Code - Chatime Loyalty App</title>
</head>
<body style = "background-color: rgb(192, 219, 247); font-family: sans-serif, Georgia">
    <h1 style= "text-align: center; font: bold 35px Georgia">Claim Referral Code</h1>
    <div style= "text-align:center">
    <a href="{{ route('users.show', auth()->id()) }}"><button style="text-align: center; font: bold 15px Georgia">⬅️ Back to Profile</button></a>
    </div>
    <hr>

    {{-- Notifikasi Klaim Jika Sukses --}}
    @if(session('success'))
        <p style="color: green; font-weight: bold;">✅ {{ session('success') }}</p>
    @endif

    {{-- Notifikasi Error --}}
    @if(session('error'))
        <p style="color: red; font-weight: bold;">❌ {{ session('error') }}</p>
    @endif

    @php
        $hasClaimed = \App\Models\Referral::where('referred_id', auth()->id())->exists();
    @endphp

    @if($hasClaimed)
        {{-- Kalau user udah pernah klaim sebelumnnya, ia tidak bisa klaim lagi --}}
    <div style="text-align: center; margin-top: 30px;">
        <p style="color: #000000; font-style: italic; font-weight: bold; background-color: #e9ecef; padding: 12px 25px; border-radius: 5px; border-left: 5px solid #6b757e; display: inline-flex; align-items: center; justify-content: center; text-align: center; max-width: 80%; gap: 8px;">
            ℹ️ You have already claimed a referral code before. This registration bonus feature can only be used once per account.
        </p>
    </div>
    @else

    <div style ="border : 2px solid #031344; padding: 20px; background-color: #fff; border-radius: 40px; margin: 0 auto; max-width: 900px;">
        {{-- Kalau user belum pernah klaim --}}
        <p>Enter the referral code you received from your friend to get the initial loyalty point bonus.</p>

        <form action="{{ route('referral.claim') }}" method="POST">
            @csrf
            
            <label for="referrer_code"><strong>Friend's Referral Code:</strong></label><br>
            <input type="text" 
                   name="referrer_code" 
                   id="referrer_code" 
                   placeholder="Example: K7X9WZ" 
                   value="{{ old('referrer_code') }}" 
                   style="text-transform: uppercase; padding: 5px;"
                   required>

            {{-- Error kalau kode tidak terdaftar --}}
            @error('referrer_code')
                <br><span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror

            <br><br>
            <button type="submit" style="padding: 5px 15px; background-color: #4e5ca4 ; color: white; cursor: pointer; font-weight: bold;">Claim Bonus Points</button>
        </form>
    @endif
    </div>
</body>
</html>