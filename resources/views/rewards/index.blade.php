<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Menu Poin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .grid-container { display: flex; gap: 20px; flex-wrap: wrap; }
        .card { border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 250px; text-align: center; }
        .btn { background-color: #007bff; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 5px; width: 100%;}
        .btn:hover { background-color: #0056b3; }
        .alert-success { color: green; margin-bottom: 15px; font-weight: bold;}
        .alert-error { color: red; margin-bottom: 15px; font-weight: bold;}
    </style>
</head>
<body>
    <body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif;">

    <h1>Tukar Poin dengan Minuman</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <div class="grid-container">
        @foreach($menus as $menu)
            <div class="card">
                <h3>{{ $menu->name }}</h3>
               <p>Harga: {{ $menu->points_required }} Poin</p>
                
                <form action="/cart/tambah" method="POST">
                    @csrf
                    <input type="hidden" name="reward_id" value="{{ $menu->id }}">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="btn">+ Tambah ke Keranjang</button>
                </form>
            </div>
        @endforeach
    </div>
    
    

</body>
</html>