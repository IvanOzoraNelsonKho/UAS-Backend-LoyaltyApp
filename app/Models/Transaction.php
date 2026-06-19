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
        'order_id',
        'recipient_name',
        'recipient_phone',
        'payment_method', 
        'bank_name',
        'order_type',
        'total_price', 
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}

// jdi ini model transaksinya buat penghubung ke tabel transaction yg di mysql
// terus kita bisa akses data user yg transaksi lewat fungsi relasi user() 
// nanti di controller kita bisa nampilin nama user di riwayat transaksi