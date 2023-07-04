<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserSettings;
use Faker\Factory as Faker;

class UserSettingsSeeder extends Seeder
{
    public function run()
    {
        $chatStyles = config('chat.chat_styles');
        $users = User::all();
        $faker = Faker::create();

        foreach ($users as $user) {
            $randomStyle = $faker->randomElement(array_keys($chatStyles));

            UserSettings::create([
                'user_id' => $user->id,
                'name' => 'default_chat_style',
                'value' => $randomStyle,
            ]);

            UserSettings::create([
                'user_id' => $user->id,
                'name' => 'public_chat_visibility',
                'value' => $faker->boolean(),
            ]);
        }
    }
}
