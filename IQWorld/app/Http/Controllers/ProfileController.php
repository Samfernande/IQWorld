<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    function profile($id)
    {
        $user = User::with('game')->findOrFail($id);

        $groupedData['games'] = $user->game->groupBy('pivot.games_id');
        $groupedData['accuracy'] = $this->getAverage($groupedData['games'], 'accuracy');
        $groupedData['reaction_time'] = $this->getAverage($groupedData['games'], 'reaction_time');

        return view('pages/profile')->with([
            'user' => $user, 
            'groupedData' => $groupedData, 
            'generalPercentage' => $this->getGeneralPercentage($id),
            'logicPercentage' => $this->getPercentageForCategory(5, $id),
            'concentrationPercentage' => $this->getPercentageForCategory(4, $id),
            'memoryPercentage' => $this->getPercentageForCategory(3, $id),
            'reflexesPercentage' => $this->getPercentageForCategory(2, $id)
        ]);
    }

    function searchProfile(Request $request)
    {
        $user = User::where('name', '=', $request->input('search'))->first();

        return $user ? $this->profile($user->id) : view('errors/404')->with(['noProfile' => 1]);
    }

    // Méthode qui récupère la moyenne d'une caractéristique pour chaque jeu
    public function getAverage($table, $column)
    {
        $averages = [];

        foreach ($table as $gameId => $gameData) {
            $columnData = $gameData->pluck("pivot.$column");
            $average = $columnData->average();
            $averages[$gameId] = round($average, 2);
        }

        return $averages;
    }

    public function store(Request $request)
    {
    $user = User::findOrFail(Auth::id());

    // Validez la demande pour vous assurer qu'un fichier a été téléchargé
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Récupérez le fichier téléchargé
    $image = $request->file('image');

    // Enregistrez l'image dans le système de fichiers public
    $path = $image->store('images', ['disk' => 'public']);

    $request->image->move(public_path('storage/images'), $path);

    $user->imgPath = $path;
    $user->save();

    return view("pages/profile")->with('user', $user);
    }

    public function getPercentageForCategory($categoryId, $userId)
    {
        $maxScores = DB::table('joueurs_points')
            ->join('games', 'joueurs_points.games_id', '=', 'games.id')
            ->where('games.category_id', $categoryId)
            ->selectRaw('joueurs_points.user_id, SUM(joueurs_points.points) as total_points')
            ->groupBy('joueurs_points.user_id')
            ->get();

        $myScore = $maxScores->where('user_id', $userId)->first();

        if ($myScore && $maxScores->count() > 1) {
            $myTotalPoints = $myScore->total_points;
            $lowerScores = $maxScores->where('total_points', '<', $myTotalPoints)->count();
            $percentage = ($lowerScores / ($maxScores->count() - 1)) * 100;
        } else {
            // Le joueur spécifié n'a pas encore enregistré de score pour les jeux de cette catégorie
            $percentage = 0;
        }

        return round($percentage);
    }

    public function getGeneralPercentage($id)
    {
        $maxScores = DB::table('joueurs_points')
            ->selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->get();

        $myScore = $maxScores->where('user_id', $id)->first();

        if ($myScore && $maxScores->count() > 1) {
            $myTotalPoints = $myScore->total_points;
            $lowerScores = $maxScores->where('total_points', '<', $myTotalPoints)->count();
            return round(($lowerScores / ($maxScores->count() - 1)) * 100);

        } else {
                return 0;
        }
    }
}
