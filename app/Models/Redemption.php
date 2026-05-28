<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $fillable = [
        'user_id', 
        'reward_id', 
        'points_spent', 
        'status'
    ];
}