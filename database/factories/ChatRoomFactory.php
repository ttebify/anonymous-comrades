<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatRoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'subject' => $this->faker->text(15),
            'created_by' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
