<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Notifikasi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100% border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 12px; background-color: #000; color: #fff; text-decoration: none; border-radius: 4px; }
        .btn:hover { background-color: #333; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-success { background-color: #d4edda; color: #155724; }
        .badge-danger { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

    <h1>Daftar Notifikasi Loyalty App</h1>

    <a href="{{ route('notifications.create') }}" class="btn">+ Tambah Notifikasi Baru</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Pesan (Message)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notification as $notification)
            <tr>
                <td>{{ $notification->id }}</td>
                <td>{{ $notification->user_id }}</td>
                <td>{{ $notification->message }}</td>
                <td>
                    @if($notification->is_read)
                        <span class="badge badge-success">Sudah Dibaca</span>
                    @else
                        <span class="badge badge-danger">Belum Dibaca</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
