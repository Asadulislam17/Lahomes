<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InboxController extends Controller
{
    // ইনবক্স পেজ দেখানোর ফাংশন
    public function index()
    {
        return view('inbox'); // resources/views/inbox.blade.php ফাইলটি ওপেন করবে
    }
}
