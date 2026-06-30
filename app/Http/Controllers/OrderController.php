<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // অর্ডার লিস্ট পেজ - ডাটাবেজ থেকে সব অর্ডার তুলে আনা হচ্ছে
    public function index()
    {
        // customer ও property রিলেশনসহ নতুন অর্ডার আগে দেখানো হবে
        $orders = Order::with(['customer', 'property'])->latest()->paginate(10);

        return view('orders', compact('orders'));
    }

    // নতুন অর্ডার সেভ করা
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'property_id' => 'required|exists:properties,id',
            'amount'      => 'required|numeric',
            'contact'     => 'nullable|string',
            'status'      => 'required|in:pending,paid,cancelled',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order added successfully!');
    }

    // অর্ডার স্ট্যাটাস আপডেট করা (যেমন paid / cancelled করা)
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    // অর্ডার ডিলিট করা
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
