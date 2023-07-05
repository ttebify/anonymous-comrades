<?php

namespace Database\Seeders;

use App\Models\PublicChat;
use Illuminate\Database\Seeder;

class PublicChatSeeder extends Seeder
{
    public function run()
    {
        PublicChat::factory()->count(5)->create();
    }
}
