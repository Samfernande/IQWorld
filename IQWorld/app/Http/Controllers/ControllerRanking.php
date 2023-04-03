<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerRanking extends Controller
{
    private $ranking = ["Beginner","Amateur","Intermediate","Professional","Expert","Master","Grand Master","Ultimate Master"];

    function rankings()
    {
        // Récupère le score max de chaque utilisateur dans chaque jeu et les additionne
        $users = User::select('users.*')
            ->selectRaw('SUM(max_points) as total_points')
            ->join(DB::raw('(SELECT user_id, games_id, MAX(points) as max_points FROM joueurs_points GROUP BY user_id, games_id) as jp'), 'jp.user_id', '=', 'users.id')
            ->join('games', 'games.id', '=', 'jp.games_id')
            ->groupBy('users.id')
            ->orderByDesc('total_points')
            ->limit(100)
            ->get();
        
        $game = games::count('games.id');

            foreach ($users as $user) {
                $user['ranking'] = $this->rankingDefiner($user['total_points'] / $game);
            }

        return view('pages/rankings')->with('user', $users);
    }

    public function rankingsGames()
    {

    }

    public function rankingDefiner($points)
    {    
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
