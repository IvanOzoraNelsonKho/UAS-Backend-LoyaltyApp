<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'description'
    ];

    // ini bikin fungsi relasi ke user biar kita bisa akses data sih user yg trnsaksi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

// jdi ini model transaksinya buat penghubung ke tabel transaction yg di mysql
// terus kita bisa akses data user yg transaksi lewat fungsi relasi user() 
// nanti di controller kita bisa nampilin nama user di riwayat transaksi