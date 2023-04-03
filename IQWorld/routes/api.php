<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{id}/{game_id}', function ($id, $game_id) {
    $lastRankUp = User::findOrFail($id)->game()->where('games.id', $game_id)->where('rank_up', 1)->latest()->first();
    $points = $lastRankUp ? ($lastRankUp['pivot']['points'] ?? 0) : 0;
    $centiles = [1000, 2000, 4000, 6000, 8000, 10000];
    $limitation = 0;

    if($points == null || $points == 0)
    {
        $limitation = 0;
    }
    else if($points > 0 && $points <= 1000)
    {
        $limitation = 0;
    }
    else if($points > 1000 && $points <= 2000)
    {
        $limitation = 1;
    }
    else if($points > 2000 && $points <= 4000)
    {
        $limitation = 2;
    }
    else if($points > 4000 && $points <= 6000)
    {
        $limitation = 3;
    }
    else if($points > 6000 && $points <= 8000)
    {
        $limitation = 4;
    }
    else if($points > 8000 && $points <= 10000)
    {
        $limitation = 5;
    }

    if ($lastRankUp && $lastRankUp['pivot'] != null && (Carbon::parse($lastRankUp->pivot->created_at)->isSameDay() || $points < $centiles[$limitation])) 
    {
        $can_update = false;
    } 
    else 
    {
        $can_update = true;
    }


    return $lastRankUp ? ['points' => $lastRankUp['pivot']['points'], 'can_update' => $can_update] : ['points' => 0, 'can_update' => $can_update];

});

Route::post('/user/{id}/{game_id}', function ($id, $game_id) {
    $points = request('points');
    $accuracy = request('accuracy');
    $reaction_time = request('reaction_time');
    $created_date = request('created_date');
    $rank_up = request('rank_up');
    $user = User::findOrFail($id);
    $user->game()->attach($game_id, ['points' => $points, 'accuracy' => $accuracy, 'reaction_time' => $reaction_time, 'created_at' => $created_date, 'rank_up' => $rank_up]);
    return ['success' => true];
});
