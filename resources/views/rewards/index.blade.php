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
    
    <div style="margin: 20px 0; border: 2px dashed red; padding: 10px; text-align: center;">
    <h3>Tes Checkout Dimari Bos:</h3>
    <form action="{{ url('/cart/checkout') }}" method="POST">
        @csrf
        <button type="submit" style="background-color: green; color: white; padding: 15px; font-size: 16px; font-weight: bold; cursor: pointer;">
            Bantai Checkout Sekarang!
        </button>
    </form>
</div>

</body>
</html>