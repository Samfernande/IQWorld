<?php

namespace Tests\Feature;

use App\Models\games;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ControllerGamesTest extends TestCase
{
    use RefreshDatabase;

    public function testGameInfo()
    {
        $game = games::factory()->create();
        $response = $this->get('/game/' . $game->id);
        $response->assertStatus(200);
        $response->assertViewIs('pages.game');
        $response->assertViewHas('game', $game);
    }
}