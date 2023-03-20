<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\games;
use App\Models\categoryGames;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ControllerGamesTest extends TestCase
{
    // Rafraîchit la base de données & Génère de fausses données
    use RefreshDatabase;
    use WithFaker;

    // Chaque méthode de test doit commencer par le mot-clé test
    public function testGameInfo()
    {
        // Création d'un objet category
        $category = new categoryGames();
        $category->name = 'Test';
        $category->description = 'Testht';
        $category->save();

        // Création d'un objet games
        $game = new games();
        $game->name = 'Test';
        $game->description = 'TEST';
        $game->category_id = 1;
        $game->save();;

        // Appel de la route qui déclenche la méthode du bon contrôleur
        $response = $this->get("/game/{$game->id}");

        // Utilisation d'assertions pour vérifier si le test est valide
        $response->assertStatus(200);
        $response->assertViewIs('pages.game');
        $response->assertViewHas('game', $game);
    }

}