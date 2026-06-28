<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
  
    public function index()
    {
        // এখানে ভবিষ্যতে ডাটাবেজ থেকে অর্ডার তুলে আনার কোড হবে, যেমন: $orders = Order::all();
        return view('orders'); 
    }
}
