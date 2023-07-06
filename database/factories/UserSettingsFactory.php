<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSettingsFactory extends Factory
{
    public function definition(): array
    {
        $chatStyles = config('chat.chat_styles');
        $randomStyle = $this->faker->randomElement(array_keys($chatStyles));

        return [
            'user_id' => User::factory(),
            'name' => 'default_chat_style',
            'value' => $randomStyle,
        ];
    }

    public function publicChatVisibility()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'public_chat_visibility',
                'value' => $this->faker->boolean(),
            ];
        });
    }
}
