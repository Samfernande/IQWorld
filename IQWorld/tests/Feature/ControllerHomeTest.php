<?php
namespace Tests\Feature;

use App\Models\games;
use App\Models\posts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ControllerHomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $games = games::factory()->count(4)->create();
        $posts = posts::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHas('games', function ($games) {
            return is_array($games) &&
                array_key_exists('reflexGame', $games) &&
                array_key_exists('memoryGame', $games) &&
                array_key_exists('logicGame', $games) &&
                array_key_exists('concentrationGame', $games);
        });
        $response->assertViewHas('posts', $posts);
    }
}