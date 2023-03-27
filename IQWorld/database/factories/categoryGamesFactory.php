<?php

namespace Database\Factories;

use App\Models\categoryGames;
use Illuminate\Database\Eloquent\Factories\Factory;

class categoryGamesFactory extends Factory
{
    protected $model = categoryGames::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
        ];
    }
}