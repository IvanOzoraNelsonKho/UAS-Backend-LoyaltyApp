<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h1>Halaman Login</h1>

    @if($errors->any())
        <p style="color: red;"><b>{{ $errors->first() }}</b></p>
    @endif
    
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>Email Address:</label><br>
        <input type="email" name="email" required value="{{ old('email') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <br>
    <p>Belum punya akun? <a href="{{ route('register') }}">Sign Up di sini</a></p>

    

</body>
</html>