<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // ট্রানজেকশন পেজ দেখানোর ফাংশন
    public function index()
    {
        return view('transactions'); // resources/views/transactions.blade.php ফাইলটি ওপেন করবে
    }
}
