<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tier</title>
</head>
<body style="font-family: Arial, sans-serif, Georgia; margin: 20px; background-color: rgb(192, 219, 247)">

    <h1>Tingkatan Membership Chatime</h1>
    <p>Kumpulkan poin transaksi sebanyak-banyaknya untuk menaikkan level tokomu!</p>
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Level</th>
                <th>Syarat Minimal Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiers as $tier)
            <tr>
                <td><b>{{ $tier->name }}</b></td>
                <td>{{ number_format($tier->min_points) }} Pts</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('users.show', auth()->id()) }}"><button>Kembali ke Profil Saya</button></a>

</body>
</html>