<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Test signing in in via API.
     *
     * This test verifies that a user can be signed in successfully via the API endpoint.
     */
    public function test_sign_in_via_api(): void
    {
            $csrfToken = csrf_token();

            $role = Role::factory()->create(['name' => 'User']);
            
            $user = User::factory()->create([
                'full_name' => 'John Doe',
                'role_id' => $role->id,
            ]);
   
            // Perform your API request
           $response = $this->withHeaders([
               'X-CSRF-TOKEN' => $csrfToken
           ])->postJson('/api/v1/auth/signin', [
               'email' => $user->email,
               'password' => 'password123',
           ]);
   
           $response->assertStatus(200);
         
    }
}
