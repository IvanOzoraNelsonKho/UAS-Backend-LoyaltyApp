<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>
    <h1>Tambah User Baru</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label>Nama:</label>
            <input type="text" name="name" required>
        </div>
        <br>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <br>
        <div>
            <label>Saldo Poin Awal:</label>
            <input type="number" name="point_balance" required>
        </div>
        <br>
        <div>
            <label>Pilih Tier:</label><br>
            <select name="tier_id" required>
                <option value="">-- Pilih Tier --</option>
                @foreach($tiers as $tier)
                    <option value="{{ $tier->id }}">{{ $tier->name }} (Min: {{ $tier->min_points }} Poin)</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="{{ route('users.index') }}">Kembali</a>
</body>
</html>