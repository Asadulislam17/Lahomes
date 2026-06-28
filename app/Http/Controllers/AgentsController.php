<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentsController extends Controller
{
    public function grid() {
        return view('agents.grid');
    }

    public function list() {
        return view('agents.list');
    }

    public function details() {
        return view('agents.details');
    }

    public function add() {
        return view('agents.add');
    }
}
