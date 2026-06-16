<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Manajemen Pesanan Masuk</title>
</head>
<body>
    <h1 style="color: darkred;">👨‍💼 DASHBOARD KASIR & ADMIN</h1>
    <h3>Pantau & Ubah Status Pembuatan Menu Chatime</h3>
    <hr>
    @if(session('success'))
        <p style="color: blue; font-weight: bold;">{{ session('success') }}</p>
    @endif
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
        <tr style="background-color: #ddd;">
            <th>ID Order</th>
            <th>Nama Pelanggan</th>
            <th>Outlet Cabang</th>
            <th>Detail Menu Item</th>
            <th>Total Uang</th>
            <th>Status Sekarang</th>
            <th>Aksi Kasir (Ganti Status)</th>
        </tr>
        @foreach($transactions as $tx)
        <tr>
          <!-- menampilkan ID Transaksi pake format #ORD-ID -->
          <td>#ORD-{{ $tx->id }}</td>
          <td><strong>{{ $tx->user->name }}</strong></td>
          <td>{{ $tx->merchant->name }}</td>
          <!-- Looping buat daftar menu minuman apa saja yang mau dibeli dlm 1 kali pembelina -->
          <td>
              @foreach($tx->details as $detail)
                  {{ $detail->reward->name }} (x{{ $detail->quantity }}), 
              @endforeach
          </td>
          <td>Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
          <!-- update buat ubah status pemesanan minuman -->
          <td><strong>{{ strtoupper($tx->status) }}</strong></td>
          <td>
              <form action="{{ route('admin.orders.update_status', $tx->id) }}" method="POST">
                  @csrf
                  @method('PATCH')             
                  <select name="status">
                      <option value="processing" {{ $tx->status == 'processing' ? 'selected' : '' }}>Processing (Preparing)</option>
                      <option value="completed" {{ $tx->status == 'completed' ? 'selected' : '' }}>Completed (Ready for Pickup)</option>
                      <option value="cancelled" {{ $tx->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  </select>
                  <button type="submit">Update</button>
              </form>
          </td>
      </tr>
        @endforeach
    </table>
</body>
</html>