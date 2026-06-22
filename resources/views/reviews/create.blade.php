<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UFT-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Review Baru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form {max-width: 400px; margin-top: 20px; border: 1px solid #ccc; padding: 20px; border-radius: 8px; }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="number"], textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; background-color: #000; color: #fff; border: none; cursor: pointer; border-radius: 4px; }
        .btn:hover { background-color: #333; }
        .back-lonk { display: inline-block; margin-top: 15px; text-decoration: none; color: #007BFF; }
    </style> 
</head>
<body style="background-color: rgb(192, 219, 247);">

    <h1>Tambah Review Baru</h1>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf

        <div>
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" id="user_id" required>
        </div>

        <div>
            <label for="reward_id">Reward ID:</label>
            <select name="reward_id" id="reward_id" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                <option value="">-- Pilih Promo --</option>
                @foreach($promotions as $promo)
                    <option value="{{ $promo->id }}">{{ $promo->title }}</option>
                @endforeach
            </select>           
        </div>

        <div>
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>
        </div>

        <div>
            <label for="comment">Komentar:</label>
            <textarea name="comment" id="comment" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn">Simpan Review</button>
    </form>

    <a href="{{ route('reviews.index') }}" class="back-link"><- Kembali ke Daftar Review</a>

</body>
</html>
