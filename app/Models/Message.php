<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'body',
        'read_at',
    ];

    // মেসেজটা কে পাঠিয়েছে
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // মেসেজটা কাকে পাঠানো হয়েছে
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
