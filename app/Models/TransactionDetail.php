<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_id',
        'reward_id',
        'quantity',
        'price',
        'size',
        'ice_level',
        'sugar_level',
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function reward() {
        return $this->belongsTo(Reward::class);
    }
}