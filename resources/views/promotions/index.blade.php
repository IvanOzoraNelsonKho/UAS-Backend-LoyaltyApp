<!DOCTYPE html>
<html>
<head>
    <title>Daftar Promo</title>
</head>
<body>
    <h1>Daftar Promo Loyalty App</h1>

    <a href="{{ route('promotions.create') }}">
        <button>+ Tambah Promo Baru</button>
    </a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Judul Promo</th>
                <th>Deskripsi</th>
                <th>Multiplier Poin</th>
                <th>Berlaku Sampai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promo)
            <tr>
                <td>{{ $promo->title }}</td>
                <td>{{ $promo->description }}</td>
                <td>{{ $promo->multiplier }}</td>
                <td>{{ $promo->end_date }}</td>
                <td>
                    <form action="{{ route('wishlists.store') }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="promotion_id" value="{{ $promo->id }}">
                        <button type="submit">
                            ❤️ Tambah ke Wishlist
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
