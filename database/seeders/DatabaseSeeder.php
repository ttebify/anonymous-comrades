<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create();

        $this->call(MessageSeeder::class);
        $this->call(ChatRoomSeeder::class);
    }
}
