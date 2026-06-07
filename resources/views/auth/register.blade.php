<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>

    <h1>Halaman Sign Up</h1>

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li><b>{{ $error }}</b></li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label>Nama Lengkap:</label><br>
        <input type="text" name="name" required value="{{ old('name') }}"><br><br>

        <label>Email Address:</label><br>
        <input type="email" name="email" required value="{{ old('email') }}"><br><br>

        <label>Password (Minimal 6 Karakter):</label><br>
        <input type="password" name="password" required><br><br>

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Daftar Akun Baru</button>
    </form>

    <br>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>

</body>
</html>