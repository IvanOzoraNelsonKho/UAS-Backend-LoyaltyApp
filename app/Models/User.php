<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'point_balance', 'tier_id', 'is_admin', 'referral_code'];

    protected static function booted()
    {
        static::creating(function ($user) {
            // Jika bukan admin (is_admin == false atau 0), otomatis dapet kode referral
            if (!$user->is_admin) {
                do {
                    $code = strtoupper(Str::random(6));
                } while (self::where('referral_code', $code)->exists());
                
                $user->referral_code = $code;
            } else {
                // Jika dia Admin (is_admin == true atau 1), kode referral dikosongkan (null)
                $user->referral_code = null;
            }
        }); 
    }

    // Setiap user memiliki satu tier keanggotaan
    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    // Menghubungkan user ke riwayat transaksi belanja mereka
    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }

    // Menghubungkan user ke riwayat mutasi poin 
    public function pointHistories() 
    {
        return $this->hasMany(PointHistory::class);
    }
}