<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicChatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraph(),
            'hidden' => $this->faker->boolean,
            'created_by' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
