<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\games;
use Illuminate\Http\Request;
use App\Models\joueursPoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ControllerGames extends Controller
{
    // Problème : Je calcul l'écart-type, ce qui n'est pas bon. Il va toujours séparer de manière égale.

    /*SQL POUR CALCUL GRAPHIQUE : SELECT quartile, AVG(points), COUNT(*) FROM (
    SELECT NTILE(10) OVER (ORDER BY points) AS quartile, points FROM joueurs_points WHERE games_id = 2
    ) subq
    GROUP BY quartile;
*/
    private $ranking = ["Beginner","Amateur","Intermediate","Professional","Expert","Master","Grand Master","Ultimate Master"];

    public function gameInfo($id)
    {
        // Récupère les variables pour le jeu
        $game = games::with('categoryGames')->findOrFail($id);
    
        // Récupère les données de l'utilisateur
        $user = User::with(['game' => function ($query) use ($id) {
                    $query->where('games.id', $id);
                }])
                ->whereHas('game', function ($query) use ($id) {
                    $query->where('games.id', $id);
                })
                ->find(Auth::id());

        // Récupère les données traitées pour les statistiques
        $statistics = DB::table(DB::raw('(
            WITH RECURSIVE intervalles AS (
                SELECT 0 AS debut, 250 AS fin
                UNION ALL
                SELECT debut + 250, fin + 250
                FROM intervalles
                WHERE fin < 12000
            )
            SELECT debut, fin
            FROM intervalles
        ) AS intervalles'))
            ->select('intervalles.debut', 'intervalles.fin', DB::raw('COUNT(joueurs_points.points) as count'))
            ->leftJoin('joueurs_points', function($join) use ($id) {
                $join->on('joueurs_points.points', '>=', 'intervalles.debut')
                    ->on('joueurs_points.points', '<', 'intervalles.fin')
                    ->where('joueurs_points.games_id', '=', $id);
            })
            ->groupBy('intervalles.debut', 'intervalles.fin')
            ->orderBy('intervalles.debut')
            ->get();

        return view('pages/game')->with([
            'game' => $game,
            'user' => $user,
            'ranking' => $this->ranking($id),
            'statistics' => $statistics
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
