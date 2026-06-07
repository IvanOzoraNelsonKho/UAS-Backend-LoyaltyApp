<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'point_balance', 'tier_id'];

    // Setiap user memiliki satu tier keanggotaan
    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}