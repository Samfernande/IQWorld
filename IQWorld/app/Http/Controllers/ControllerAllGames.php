<?php

namespace App\Http\Controllers;

use App\Models\games;
use Illuminate\Http\Request;

class ControllerAllGames extends Controller
{
    public function allGames()
    {
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

        return view('pages/allGames')
            ->with('games', $games)
            ->with('gameOfDay', $gameOfDay)
            ->with('logicGame', $this->getAllGamesByCategory(5))
            ->with('concentrationGame', $this->getAllGamesByCategory(4))
            ->with('memoryGame', $this->getAllGamesByCategory(3))
            ->with('reflexGame', $this->getAllGamesByCategory(2));
    }

    public function getAllGamesByCategory($id)
    {
        return games::with('categoryGames')->where('category_id', '=', $id)->get();
    }
}
