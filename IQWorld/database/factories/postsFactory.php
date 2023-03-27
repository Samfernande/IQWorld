<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\posts;
use Illuminate\Database\Eloquent\Factories\Factory;

class postsFactory extends Factory
{
    protected $model = posts::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'id_author' => User::factory(),
        ];
    }
}
