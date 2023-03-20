<?php

namespace App\Http\Controllers;

use App\Models\games;
use Illuminate\Http\Request;

class ControllerGames extends Controller
{
    public function gameInfo($id)
    {
        $game = games::with('categoryGames')->findOrFail($id);

        return view('pages/game')->with('game', $game);
    }
}
