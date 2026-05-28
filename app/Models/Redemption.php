<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'reward_id', 'merchant_id', 'status'];
}
