<?php

namespace Database\Factories;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraph,
            'sender' => User::factory(),
            'chat_room' => ChatRoom::factory(),
        ];
    }
}
