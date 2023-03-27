<?php

namespace Database\Factories;

use App\Models\games;
use App\Models\categoryGames;
use Illuminate\Database\Eloquent\Factories\Factory;

class gamesFactory extends Factory
{
    protected $model = games::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'category_id' => categoryGames::factory(),
        ];
    }
}