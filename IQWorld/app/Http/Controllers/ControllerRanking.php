<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerRanking extends Controller
{
    function rankings()
    {
        return view('pages/rankings');
    }
}
