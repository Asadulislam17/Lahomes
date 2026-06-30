<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        // Featured properties (প্রথম 6টি)
        $properties = Property::latest()->take(6)->get();

        // Latest properties (সর্বশেষ 6টি)
        $latestProperties = Property::orderBy('created_at', 'desc')->take(6)->get();

        // Testimonials (যদি থাকে)
        $testimonials = Testimonial::latest()->take(3)->get();

        // সবগুলো variable view‑এ পাঠানো হচ্ছে
        return view('welcome', compact('properties', 'latestProperties', 'testimonials'));
    }
}
