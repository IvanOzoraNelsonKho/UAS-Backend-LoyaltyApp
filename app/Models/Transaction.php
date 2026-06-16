<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory; 

    protected $fillable = [
        'user_id',
        'merchant_id', 
        'total_amount', 
        'points_earned', 
        'payment_method', 
        'status', 
        'transaction_date'
    ];

    // ini bikin fungsi relasi ke user biar kita bisa akses data sih user yg trnsaksi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // relasi ke merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // Relasi ke Item Detail Pesanan
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}

// jdi ini model transaksinya buat penghubung ke tabel transaction yg di mysql
// terus kita bisa akses data user yg transaksi lewat fungsi relasi user() 
// nanti di controller kita bisa nampilin nama user di riwayat transaksi