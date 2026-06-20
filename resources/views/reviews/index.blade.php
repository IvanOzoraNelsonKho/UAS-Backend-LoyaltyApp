<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Review Loyalty App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { display: inline-block; padding: 8px 12px; background-color: #f2f2f2; border: 1px solid #000; text-decoration: none; color: #000; border-radius: 4px; font-size: 14px; }
    </style>
</head>
<body style="background-color: rgb(192, 219, 247);">

    <h1>Daftar Review Loyalty App</h1>

    <a href="{{ route('reviews.create') }}" class="btn">+ Tambah Review Baru</a>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Reward ID</th>
                <th>Rating</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
               <tr>
                   <td>{{ $review->user_id }}</td>
                   <td>{{ $review->reward_id }}</td>
                   <td>{{ $review->rating }}</td>
                   <td>{{ $review->comment }}</td>
               </tr>
            @endforeach
        </tbody>
</table>

</bodyy>
</html>