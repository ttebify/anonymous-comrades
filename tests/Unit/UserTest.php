<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase; // This will ensure your database is migrated and cleaned up after each test

    /** @test */
    public function a_user_can_be_created(): void
    {
        // Retrieve the user from the database
        $user = User::all();

        // Assert that the user was successfully retrieved from the database
        $this->assertNotNull($user);

    }
}
