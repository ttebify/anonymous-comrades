<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Database\Seeder;

class UserSettingsSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        $users->each(function ($user) {
            UserSettings::factory()
                ->for($user)
                ->create();

            UserSettings::factory()
                ->for($user)
                ->publicChatVisibility()
                ->create();
        });
    }
}
