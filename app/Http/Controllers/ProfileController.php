<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // প্রোফাইল এডিট পেজ দেখানোর জন্য
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // প্রোফাইল আপডেট করার জন্য
    public function update(Request $request): RedirectResponse
    {
        // আপনার ভ্যালিডেশন এবং আপডেট লজিক এখানে হবে
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    // অ্যাকাউন্ট ডিলিট করার জন্য
    public function destroy(Request $request): RedirectResponse
    {
        // আপনার অ্যাকাউন্ট ডিলিট করার লজিক এখানে হবে
        Auth::logout();
        $request->user()->delete();

        return redirect('/');
    }
}
    