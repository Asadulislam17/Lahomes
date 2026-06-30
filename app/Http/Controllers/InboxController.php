<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    // ইনবক্স - আমি যেসব মেসেজ পেয়েছি তার লিস্ট
    public function index()
    {
        $myId = Auth::id();

        $messages = Message::with('sender')
            ->where('receiver_id', $myId)
            ->latest()
            ->paginate(15);

        return view('inbox', compact('messages'));
    }
}
