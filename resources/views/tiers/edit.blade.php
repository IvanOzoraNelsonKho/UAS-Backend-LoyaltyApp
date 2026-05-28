<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tier</title>
</head>
<body>
    <h1>Edit Tier</h1>
    <form action="{{ route('tiers.update', $tier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nama Tier: </label><br>
            <input type="text" name="name" value="{{ $tier->name }}" required>
        </div>
        <br>
        
        <div>
            <label>Minimal Poin: </label><br>
            <input type="number" name="min_points" value="{{ $tier->min_points }}" required>
        </div>
        <br>

        <button type="submit">Update Data</button>
    </form>

    <br>
    <a href="{{ route('tiers.index') }}"><button>Kembali</button></a>
</body>
</html>