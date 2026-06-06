<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit Data User</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nama:</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>
        <br>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>
        <br>
        <div>
            <label>Saldo Poin:</label>
            <input type="number" name="point_balance" value="{{ $user->point_balance }}" min="0" required>
        </div>
        <br>
        <div>
            <label>Pilih Tier:</label><br>
            <select name="tier_id" required>
                @foreach($tiers as $tier)
                    <option value="{{ $tier->id }}" {{ $user->tier_id == $tier->id ? 'selected' : '' }}>
                        {{ $tier->name }} (Min: {{ $tier->min_points }} Poin)
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Update</button>
    </form>
    <br>
    <a href="{{ route('users.index') }}">Kembali</a>
</body>
</html>