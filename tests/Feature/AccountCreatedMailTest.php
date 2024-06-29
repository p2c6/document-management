<?php

namespace Tests\Feature;

use App\Mail\AccountCreated;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountCreatedMailTest extends TestCase
{
    /**
     * Test content is indicated upon user mailing.
     */
    public function test_mailable_content_upon_account_creation(): void
    {
        // Create a role (if not already created)
        $role = Role::factory()->create(['name' => 'User']);

        // Create a user using the modified factory
        $user = User::factory()->create([
            'full_name' => 'John Doe', // Optional: Provide specific full name
            'role_id' => $role->id,
        ]);


        $mailable = new AccountCreated($user);

        $mailable->assertFrom('systemsys@gmail.com');
        $mailable->assertTo($user->email);
        $mailable->assertSeeInHtml($user->email);
        $mailable->assertSeeInHtml($user->full_name);

    }
}
