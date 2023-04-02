<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ControllerGames extends Controller
{
    private $ranking = ["Beginner","Amateur","Intermediate","Professional","Expert","Master","Grand Master","Ultimate Master"];

    public function gameInfo($id)
    {
        $game = games::with('categoryGames')->findOrFail($id);
    
        $user = User::with(['game' => function ($query) use ($id) {
                    $query->where('games.id', $id);
                }])
                ->whereHas('game', function ($query) use ($id) {
                    $query->where('games.id', $id);
                })
                ->find(Auth::id());

        return view('pages/game')->with([
            'game' => $game,
            'user' => $user,
            'ranking' => $this->ranking($id)
        ]);
    }

    public function ranking($idGame)
{
    $user = User::with(['game' => function ($query) use ($idGame) {
        $query->where('games.id', $idGame);
    }])
    ->whereHas('game', function ($query) use ($idGame) {
        $query->where('games.id', $idGame);
    })
    ->find(Auth::id());
    
    if ($user === null || $user->game->isEmpty()) {
        return $this->ranking[0];
    }
    
    $points = DB::table('joueurs_points')
                ->where('user_id', Auth::id())
                ->where('rank_up', 1)
                ->where('games_id', $idGame)
                ->max('points');
    
    if($points == 0 || empty($points))
    {
        return $this->ranking[0];
    }
    elseif($points > 0 && $points <= 1000)
    {
        return $this->ranking[1];
    }
    elseif($points > 1000 && $points <= 2000)
    {
        return $this->ranking[2];
    }
    elseif($points > 2000 && $points <= 4000)
    {
        return $this->ranking[3];
    }
    elseif($points > 4000 && $points <= 6000)
    {
        return $this->ranking[4];
    }
    elseif($points > 6000 && $points <= 8000)
    {
        return $this->ranking[5];
    }
    elseif($points > 8000 && $points <= 10000)
    {
        return $this->ranking[6];
    }
    else
    {
        return $this->ranking[7];
    }
}
}
