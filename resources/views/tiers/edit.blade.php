<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tier</title>
</head>
<body style="font-family: Arial, sans-serif, Georgia; margin: 20px; background-color: rgb(192, 219, 247)">
    <h1>Edit Tier</h1>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li><b>{{ $error }}</b></li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('tiers.update', $tier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nama Tier: </label><br>
            <input type="text" name="name" value="{{ old('name', $tier->name) }}" required>
        </div>
        <br>
        
        <div>
            <label>Minimal Poin: </label><br>
            <input type="number" name="min_points" value="{{ old('min_points', $tier->min_points) }}" min="0" required>
        </div>
        <br>

        <button type="submit">Update Data</button>
    </form>

    <br>
    <a href="{{ route('tiers.index') }}"><button>Kembali</button></a>
</body>
</html>