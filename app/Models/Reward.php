<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'category_id', 
        'name', 
        'description', 
        'points_required', 
        'stock'
    ];
}