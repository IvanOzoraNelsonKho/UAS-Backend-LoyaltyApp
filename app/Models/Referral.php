<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referral extends Model
{
    use HasFactory;

    // daftarin kolom yg bisa diisi otomatis pas daftar akun via referral
    protected $fillable = [
        'referrer_id',
        'referred_id',
        'bonus_points',
    ];

    // liat siapa customer yang ngajak gabung
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    // buat liat siapa member baru yg diajak gabung
    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }
}
