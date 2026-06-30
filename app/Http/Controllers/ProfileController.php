<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
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

    // নাম/ইমেইল/ফোন/ঠিকানা/ছবি আপডেট করার জন্য
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string',
            'experience' => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;
        $user->address    = $request->address;
        $user->experience = $request->experience;

        // নতুন ছবি আপলোড করলে পুরোনোটা মুছে নতুনটা সেভ হবে
        if ($request->hasFile('photo')) {
            if ($user->photo && File::exists(public_path($user->photo))) {
                File::delete(public_path($user->photo));
            }
            $photoName = time() . '_' . uniqid() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $photoName);
            $user->photo = 'uploads/profile/' . $photoName;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    // পাসওয়ার্ড পরিবর্তন করার জন্য
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password'          => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'password-updated');
    }

    // অ্যাকাউন্ট ডিলিট করার জন্য
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = $request->user();

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
