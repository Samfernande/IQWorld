<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    function profile($id)
    {
        $user = User::with('game')->findOrFail($id);

        return view('pages/profile')->with('user', $user);
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
}
