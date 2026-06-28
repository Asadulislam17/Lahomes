<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // ডাটাবেজ থেকে ডেটা আনার জন্য এবং সেভ করার জন্য মডেল

class PropertyController extends Controller
{
    // ==========================================
    // অ্যাডমিন এবং এজেন্টদের জন্য (ড্যাশবোর্ড ভিউ)
    // ==========================================
    public function grid() {
        return view('property.grid'); 
    }

    public function list() {
        return view('property.list'); 
    }

    public function details() {
        return view('property.details'); 
    }

    public function add() {
        return view('property.add'); 
    }

    // ==========================================
    // কাস্টমার বা সাধারণ ভিজিটরদের জন্য (পাবলিক ভিউ)
    // ==========================================
    
    // কাস্টমার সব প্রোপার্টি একসাথে দেখবে
    public function publicIndex() {
        return view('property.grid'); 
    }

    // কাস্টমার প্রোপার্টির ডিটেইলস দেখবে এবং কেনার বাটন পাবে
    public function publicDetails($id) {
        return view('property.details'); 
    }

    // ==========================================
    // ব্যাকএন্ড লজিক: ডাটাবেজে প্রোপার্টি সেভ করা
    // ==========================================
    public function store(Request $request)
    {
        // ১. ফরমের ডেটা ভ্যালিডেশন করা
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'property_for' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // সর্বোচ্চ ২ মেগাবাইট
        ]);

        // ২. ড্রপজোন/ফাইল ইনপুট থেকে ইমেজ আপলোড প্রসেস করা
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            // public/uploads/properties/ ফোল্ডারে ইমেজটি সেভ হবে
            $request->image->move(public_path('uploads/properties'), $imageName);
            $imagePath = 'uploads/properties/' . $imageName;
        }

        // ৩. ডাটাবেজে নতুন প্রোপার্টি রেকর্ড তৈরি করা
        Property::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'property_for' => $request->property_for,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'sqft' => $request->sqft,
            'floor' => $request->floor,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'country' => $request->country,
            'image' => $imagePath,
        ]);

        // ৪. সফলভাবে সেভ হওয়ার পর লিস্ট পেজে রিডাইরেক্ট করা
        return redirect()->route('property.list')->with('success', 'Property added successfully!');
    }
}
