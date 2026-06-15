<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $fillable = ['name', 'min_points'];

    // Satu tier bisa dimiliki oleh banyak user
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
