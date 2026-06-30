<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // ড্যাশবোর্ডের উপরের কার্ডগুলোতে দেখানোর জন্য আসল হিসাব
        $totalProperties = Property::count();
        $totalAgents     = User::where('role', 'agent')->count();
        $totalCustomers  = User::where('role', 'customer')->count();
        $totalRevenue    = Transaction::where('status', 'success')->sum('amount');

        return view('dashboards.analytics', compact(
            'totalProperties', 'totalAgents', 'totalCustomers', 'totalRevenue'
        ));
    }
}
