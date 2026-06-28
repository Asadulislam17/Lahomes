<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    // মেসেজ পেজ দেখানোর ফাংশন
    public function index()
    {
        return view('messages'); // resources/views/messages.blade.php ফাইলটি ওপেন করবে
    }
}
