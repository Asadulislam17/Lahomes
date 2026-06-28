<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function grid() {
        return view('property.grid'); // property ফোল্ডারের grid ফাইল
    }

    public function list() {
        return view('property.list'); // property ফোল্ডারের list ফাইল
    }

    public function details() {
        return view('property.details'); // property ফোল্ডারের details ফাইল
    }

    public function add() {
        return view('property.add'); // property ফোল্ডারের add ফাইল
    }
}
