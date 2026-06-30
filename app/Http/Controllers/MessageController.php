<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // মেসেজ পেজ - সব ইউজারের লিস্ট ও সিলেক্ট করা ইউজারের সাথে কথোপকথন দেখাবে
    public function index(Request $request)
    {
        $myId = Auth::id();

        // আমি ছাড়া বাকি সব ইউজার (কন্টাক্ট লিস্ট হিসেবে)
        $contacts = User::where('id', '!=', $myId)->orderBy('name')->get();

        // কার সাথে চ্যাট করছি (URL এ ?with=ইউজার_আইডি দিয়ে আসবে)
        $withUserId = $request->get('with');
        $activeContact = null;
        $conversation = collect();

        if ($withUserId) {
            $activeContact = User::find($withUserId);

            if ($activeContact) {
                $conversation = Message::where(function ($q) use ($myId, $withUserId) {
                        $q->where('sender_id', $myId)->where('receiver_id', $withUserId);
                    })
                    ->orWhere(function ($q) use ($myId, $withUserId) {
                        $q->where('sender_id', $withUserId)->where('receiver_id', $myId);
                    })
                    ->orderBy('created_at')
                    ->get();
            }
        }

        return view('messages', compact('contacts', 'activeContact', 'conversation'));
    }

    // নতুন মেসেজ পাঠানো
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body'        => 'required|string',
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body'        => $request->body,
        ]);

        return redirect()->route('messages.index', ['with' => $request->receiver_id]);
    }
}
