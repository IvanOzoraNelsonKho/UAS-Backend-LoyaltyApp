<!DOCTYPE html>
<html>
<head>
    <title>Wishlist Saya</title>
</head>
<body>
    <h1>Daftar Wishlist (Promo Incaran)</h1>

    <a href="{{ route('promotions.index') }}">
        <button> <- Kembali ke Daftar Promo</button>
    </a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Promo Disimpan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        </tbody>
            @forelse($wishlists as $index => $wishlist)
            <tr>
                <td>{{ $index + 1}}</td>
                <td>Promo ID: {{ $wishlist->promotion_id }}</td>
                <td>
                    <form action="{{ route('wishlists.destroy', $wishlist->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return comfirm('Yakin mau hapus dari wishlist?')">
                            💔 Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center;">Belum ada promo yang kamu simpan nih.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
