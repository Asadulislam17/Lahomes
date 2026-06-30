<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AgentsController extends Controller
{
    // role = agent এমন ইউজারদেরই আমরা "Agent" হিসেবে ধরছি
    public function grid()
    {
        $agents = User::where('role', 'agent')->latest()->paginate(8);
        return view('agents.grid', compact('agents'));
    }

    public function list()
    {
        $agents = User::where('role', 'agent')->latest()->paginate(10);
        return view('agents.list', compact('agents'));
    }

    public function details(Request $request)
    {
        $id = $request->get('id');

        if ($id) {
            $agent = User::where('role', 'agent')->findOrFail($id);
        } else {
            $agent = User::where('role', 'agent')->latest()->first();
        }

        return view('agents.details', compact('agent'));
    }

    public function add()
    {
        return view('agents.add');
    }

    // নতুন এজেন্ট তৈরি করা (এজেন্ট আসলে role=agent দিয়ে একজন user)
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'nullable|string',
            'address'    => 'nullable|string',
            'experience' => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoName = time() . '_' . uniqid() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/agents'), $photoName);
            $photoPath = 'uploads/agents/' . $photoName;
        }

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make('password'), // ডিফল্ট পাসওয়ার্ড, এজেন্ট পরে পাল্টে নিতে পারবে
            'role'       => 'agent',
            'phone'      => $request->phone,
            'address'    => $request->address,
            'experience' => $request->experience,
            'photo'      => $photoPath,
        ]);

        return redirect()->route('agents.list')->with('success', 'Agent added successfully!');
    }

    // এজেন্ট ডিলিট করা
    public function destroy($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);

        if ($agent->photo && File::exists(public_path($agent->photo))) {
            File::delete(public_path($agent->photo));
        }

        $agent->delete();

        return redirect()->route('agents.list')->with('success', 'Agent deleted successfully!');
    }
}
