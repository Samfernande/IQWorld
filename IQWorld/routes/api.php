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

    if ($lastRankUp && $lastRankUp['pivot'] != null && (Carbon::parse($lastRankUp->pivot->created_at)->isSameDay())) 
    {
        $can_update = false;
    } 
    else 
    {
        $can_update = true;
    }

    return $lastRankUp ? ['c54a061dfcc125cb160421b2680feaf6d65d938d756d887fe4d8d1d046eb626e' => $points, 
                        'f542c4918a6de6ca67985802d28a5b4bac06b669f5f3a576c767c574d1bd3b8f' => $can_update, 
                        'c90a766a1e6b469b8e99f3fe6663316a8d701fb883168fbed768be593a1665f6' => $centiles[$limitation]] : 
                        ['c54a061dfcc125cb160421b2680feaf6d65d938d756d887fe4d8d1d046eb626e' => 0,
                         'f542c4918a6de6ca67985802d28a5b4bac06b669f5f3a576c767c574d1bd3b8f' => $can_update,
                          'c90a766a1e6b469b8e99f3fe6663316a8d701fb883168fbed768be593a1665f6' => $centiles[$limitation]];

});

Route::post('/user/{id}/{game_id}', function ($id, $game_id) {
    
    $lastRankUp = User::findOrFail($id)->game()->where('games.id', $game_id)->where('rank_up', 1)->latest()->first();

    $points = request('c54a061dfcc125cb160421b2680feaf6d65d938d756d887fe4d8d1d046eb626e');
    $accuracy = request('ac991dd3c2d928da95b77afb954db61a3246be27b683f30d1232dcee625ae376');
    $reaction_time = request('d54811bd86d428ebc653d0a69354c29a3403ffd993d28a4bbef54f66715771eb');
    $created_date = request('a1f93bd5ca6444572f1e0692b419f5f843312172316c50ccb9c5d57b1a6933ab');
    $rank_up = request('b5bd51ca3d2f78b2d868b401273a4d4988c95103fa7005fe004311484fb25510');
    $user = User::findOrFail($id);

    $user->game()->attach($game_id, ['points' => $points, 'accuracy' => $accuracy, 'reaction_time' => $reaction_time, 'created_at' => $created_date, 'rank_up' => $rank_up]);
    return ['success' => true];
});
