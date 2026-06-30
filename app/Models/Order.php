<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'property_id',
        'amount',
        'contact',
        'status',
    ];

    // এই অর্ডারটা কোন কাস্টমারের
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // এই অর্ডারটা কোন প্রপার্টির জন্য
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // এই অর্ডারের সব পেমেন্ট/ট্রানজেকশন
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
