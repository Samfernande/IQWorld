<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ControllerGames;
use App\Http\Controllers\ControllerRanking;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;

/*
|---------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes

Route::get('/', [ControllerHome::class, 'index'])->name('home');

Route::get('/game/{id}', [ControllerGames::class, 'gameInfo'])->name('gameInfo');

Route::get('/language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile');

Route::post('/profile/{id}', [ProfileController::class, 'store'])->name('profile');

Route::get('/rankings', [ControllerRanking::class, 'rankings'])->name('rankings');

Route::get('/rankings/games/{id}', [ProfileController::class, 'rankingsGames'])->name('rankingsGames');





// TRUCS CHIANTS 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
