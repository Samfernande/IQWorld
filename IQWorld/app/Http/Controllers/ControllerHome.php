<?php

namespace App\Http\Controllers;

use App\Models\games;
use Illuminate\Http\Request;

class ControllerHome extends Controller
{
    public function index()
    {
        $data = games::latest()->take(3)->get();
        return view('pages/home')->with('data', $data);
    }
}
