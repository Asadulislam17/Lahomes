<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'category', 
        'price', 
        'property_for', 
        'bedroom', 
        'bathroom', 
        'sqft', 
        'floor', 
        'address', 
        'zip_code', 
        'city', 
        'country', 
        'image'
    ];

    // এই প্রপার্টির জন্য যত অর্ডার হয়েছে
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
