<?php

namespace App\Http\Controllers;

use App\Models\games;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ControllerHome extends Controller
{
    public function index()
    {
        // Récupère les 3 derniers jeux avec la table categoryGame
        $games = games::with('categoryGames')->latest()->take(3)->get();

        // Récupère les 3 derniers postes avec la table users
        $posts = posts::with('users')->latest()->take(3)->get();

        // Récupère tous les jeux
        $allGames = games::with('categoryGames')->get();

        $date = date('j');

        srand($date);

        $gameOfDay = [];

        
        $reflexGame = $allGames->where('category_id', '=', 2)->values()[rand(0, $allGames->where('category_id', '=', 2)->count() - 1)];
        $memoryGame = $allGames->where('category_id', '=', 3)->values()[rand(0, $allGames->where('category_id', '=', 3)->count() - 1)];
        $logicGame = $allGames->where('category_id', '=', 5)->values()[rand(0, $allGames->where('category_id', '=', 5)->count() - 1)];
        $concentrationGame = $allGames->where('category_id', '=', 4)->values()[rand(0, $allGames->where('category_id', '=', 4)->count() - 1)];

        $games = [ // créer un tableau avec des clés personnalisées
            "reflexGame" => $reflexGame,
            "memoryGame" => $memoryGame,
            "logicGame" => $logicGame,
            "concentrationGame" => $concentrationGame
        ];


        array_push($gameOfDay, $games);

        return view('pages/home')->with('games', $games)->with('posts', $posts)->with('gameOfDay', $gameOfDay);
    }
}
