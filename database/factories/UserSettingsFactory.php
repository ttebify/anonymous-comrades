<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSettings>
 */
class UserSettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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

    /**
     * Define the "public_chat_visibility" state.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
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
