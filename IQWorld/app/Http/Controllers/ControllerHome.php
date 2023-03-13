<?php

namespace App\Http\Controllers;

use App\Models\games;
use Illuminate\Http\Request;

class ControllerHome extends Controller
{
    public function index()
    {
        // Récupère les 3 derniers jeux avec la table categoryGame
        $data = games::with('categoryGames')->latest()->take(3)->get();

        return view('pages/home')->with('data', $data);
    }
}
