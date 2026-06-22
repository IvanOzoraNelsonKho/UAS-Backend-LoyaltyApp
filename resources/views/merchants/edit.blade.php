<html>
<head>
    <title>Edit Merchant</title>
</head>
<body style="background-color: rgb(192, 219, 247); font-family: Georgia, Arial, sans-serif; padding: 20px;">
    <h1>Edit Merchant</h1>

<form action="{{ route('merchants.update', $merchant->id) }}" method="POST">
    @csrf
    @method('PUT') 
    
    <label for="name">Nama Merchant:</label><br>
    <input type="text" id="name" name="name" value="{{ $merchant->name }}" required><br><br>

    <label for="location">Lokasi:</label><br>
    <input type="text" id="location" name="location" value="{{ $merchant->location }}" required><br><br>

    <label for="contact_info">Kontak Info:</label><br>
    <input type="text" id="contact_info" name="contact_info" value="{{ $merchant->contact_info }}"><br><br>

    <button type="submit">Update Merchant</button>
</form>

<br>
<a href="{{ route('merchants.index') }}">Kembali ke Daftar</a>
</body>
</html>