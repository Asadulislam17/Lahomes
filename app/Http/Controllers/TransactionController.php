<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // ট্রানজেকশন লিস্ট পেজ - ডাটাবেজ থেকে সব ট্রানজেকশন তুলে আনা হচ্ছে
    public function index()
    {
        $transactions = Transaction::with('order.customer')->latest()->paginate(10);

        return view('transactions', compact('transactions'));
    }

    // নতুন ট্রানজেকশন সেভ করা
    public function store(Request $request)
    {
        $request->validate([
            'order_id'       => 'required|exists:orders,id',
            'amount'         => 'required|numeric',
            'payment_method' => 'required|string',
            'status'         => 'required|in:pending,success,failed',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully!');
    }
}
