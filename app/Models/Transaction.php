<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'status',
    ];

    // এই ট্রানজেকশনটা কোন অর্ডারের
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
