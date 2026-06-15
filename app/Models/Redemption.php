<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'reward_id', 'merchant_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id'); 
    }
    
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
