<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PublicChat;
use App\Models\User;
use Faker\Factory as Faker;

class PublicChatSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        for ($i = 1; $i <= 5; $i++) {
            PublicChat::create([
                'content' => $faker->paragraph(),
                'hidden' => $faker->boolean(),
                'createdBy' => $users->random()->id,
            ]);
        }
    }
}
