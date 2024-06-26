<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * Test creating a new role via API.
     *
     * This test verifies that a role can be created successfully via the API endpoint.
     */
    public function test_create_role_via_api(): void
    {
        // Send a POST request to create a new role
        $response = $this->postJson('/api/v1/roles/store', ['name' => 'User']);

        // Assert that the response status is HTTP 201 Created
        $response->assertStatus(201);
    }
}
