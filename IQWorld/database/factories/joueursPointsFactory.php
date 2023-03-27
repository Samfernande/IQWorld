<?php
namespace Database\Factories;

use App\Models\games;
use App\Models\User;
use App\Models\joueursPoints;
use Illuminate\Database\Eloquent\Factories\Factory;

class joueursPointsFactory extends Factory
{
    protected $model = joueursPoints::class;

    public function definition()
    {
        return [
            'points' => $this->faker->numberBetween(0, 100),
            'user_id' => User::factory(),
            'game_id' => games::factory(),
        ];
    }
}