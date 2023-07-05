<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ChatRoomSeeder::class);
        $this->call(PublicChatSeeder::class);
        $this->call(UserSettingsSeeder::class);
    }
}
