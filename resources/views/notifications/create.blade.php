<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UFT-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Notifikasi Baru</title>
    <style>
        body { font-family: Arial, sans_serif; margin: 20px; }
        form { max-width: 400px; margin-top: 20px; border: 1px solid #ccc; padding: 20px; border-radius: 8px; }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="number"], textarea, select { width:100% padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; background-color: #000; color: #fff; border: none; cursor: pointer; border-radius: 4px; }
        .btn:hover { background-color: #333; }
        .back-link { display: inline-block; margin-top: 15px; text-decoration: none; color: #007BFF; }
    </style>
</head>
<body> 

    <h1>Tambah Notifikasi Baru</h1>

    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf

        <div>
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" id="user_id" required>
        </div>

        <div>
            <label for="message">Pesan Notifikasi:</label>
            <textarea name="message" id="message" rows="4" required></textarea>
        </div>

        <div>
            <label for="is_read">Status:</label>
            <select name="is_read" id="is_read" required>
                <option value="0">Belum Dibaca</option>
                <option value="1">Suudah Dibaca</option>
            </select>
        </div>

        <button type="submit" class="btn">Simpan Notifikasi</button>
    </form>

    <a href="{{ route('notifications.index') }}" class="back-link"><- Kembali ke Daftar Notifikasi</a>

</body>
</html>
