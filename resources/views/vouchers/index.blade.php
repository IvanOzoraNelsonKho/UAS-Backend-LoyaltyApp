<h1>Daftar Voucher</h1>

<a href="{{ route('vouchers.create') }}">Tambah Voucher</a>
<br><br>

@if ($vouchers->isEmpty())
    <p>Belum ada voucher yang tersimpan</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th style="width: 150px;">Kode Voucher</th>
            <th style="width: 150px;">Nilai Diskon</th>
            <th style="width: 150px;">Status</th>
            <th style="width: 120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vouchers as $index => $voucher)
        <tr>
            <td style="text-align: center;">{{ $loop->iteration }}</td>
            <td>{{ $voucher->code }}</td>
            <td>{{ $voucher->discount_value }}</td>
            <td>{{ $voucher->is_used ? 'Sudah Terpakai' : 'Belum Dipakai' }}</td>
            <td style="text-align: center;">
                <a href="{{ route('vouchers.edit', $voucher) }}">Ubah</a> |
                <form action="{{ route('vouchers.destroy', $voucher) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus voucher ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<br>
<a href="{{ route('merchants.index') }}">Ke Halaman Merchant</a>