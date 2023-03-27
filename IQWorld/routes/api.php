<?php

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

// Permet de récupérer les points du joueur par rapport au jeu sur lequel il est.
Route::get('/user/{id}/{game_id}', function ($id, $game_id) {
    $points = User::findOrFail($id)->game()->where('games.id', $game_id)->pluck('points')->first();
    return ['points' => $points];
});

// Méthode qui permet de mettre à jour les points du joueur
Route::post('/user/{id}/{game_id}', function ($id, $game_id) {
    $points = request('points');
    $user = User::findOrFail($id);
    $user->game()->syncWithoutDetaching([$game_id => ['points' => $points]]);
    return ['success' => true];
});
