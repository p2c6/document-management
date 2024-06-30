<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test getting all application via API.
     *
     * This test verifies that an application can be fetched successfully via the API endpoint.
     */
    public function test_get_all_application_via_api()
    {
        // Create a role (if not already created)
        $role = Role::factory()->create(['name' => 'User']);

        // Create a user using the modified factory
        $user = User::factory()->create([
            'full_name' => 'John Doe', // Optional: Provide specific full name
            'role_id' => $role->id,
        ]);

        $this->actingAs($user);

        // Retrieve CSRF token
        $csrfToken = csrf_token();

        // Perform your API request
        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken
        ])->postJson('/api/v1/application/store', [
            'date_needed' => '2024-05-06',
            'remarks' => 'Test',
            'status' => 'Submitted',
            'user_id' => $user->id
        ]);

        // Perform your API request
        $response = $this->getJson('/api/v1/application');        

        // Assert the response
        $response->assertOk();
        $response->assertJson([
            'data' => $response['data']
        ]);
    }

    /**
     * Test posting new application via API.
     *
     * This test verifies that an application can be posted successfully via the API endpoint.
     */
    public function test_post_application_via_api()
    {
        // Create a role (if not already created)
        $role = Role::factory()->create(['name' => 'User']);

        // Create a user using the modified factory
        $user = User::factory()->create([
            'full_name' => 'John Doe', // Optional: Provide specific full name
            'role_id' => $role->id,
        ]);

        $this->actingAs($user);

        // Retrieve CSRF token
        $csrfToken = csrf_token();

        // Perform your API request
        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken
        ])->postJson('/api/v1/application/store', [
            'date_needed' => '2024-05-06',
            'remarks' => 'Test',
            'status' => 'Submitted',
            'user_id' => $user->id
        ]);
        $data = json_decode($response->content(), true);

        // Assert the response status
        $response->assertCreated();
        $response->assertJson([
            'status' => 'success',
            'message' => 'Application Submitted!',
            'data' => $data['data']
        ]);
    }
    
    /**
     * Test updating an application via API.
     *
     * This test verifies that an application can be updated successfully via the API endpoint.
     */
    public function test_update_application_via_api()
    {
        // Create a role (if not already created)
        $role = Role::factory()->create(['name' => 'User']);

        // Create a user using the modified factory
        $user = User::factory()->create([
            'full_name' => 'John Doe', // Optional: Provide specific full name
            'role_id' => $role->id,
        ]);

        // Create an application (if needed)
        $application = Application::factory()->create([
            'date_needed' => '2024-05-06',
            'remarks' => 'Initial remarks',
            'status' => 'Submitted',
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        // Retrieve CSRF token
        $csrfToken = csrf_token();

        // Perform your API request to update the application
        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken,
        ])->putJson('/api/v1/application/update/'.$application->id, [
            'date_needed' => '2024-06-15', // Updated date needed
            'remarks' => 'Updated remarks', // Updated remarks
            'status' => 'Resubmitted', // Updated status
            'user_id' => $user->id, // Ensure user_id remains unchanged
        ]);

        $response->assertOk();

        // Optionally, assert specific changes in the updated application
        $this->assertNotEquals('2024-06-15', $application->fresh()->date_needed);
        $this->assertNotEquals('Updated remarks', $application->fresh()->remarks);
        $this->assertNotEquals('Resubmitted', $application->fresh()->status);

        $response->assertJson([
            'status' => 'success',
            'message' => 'Application Resubmitted!',
        ]);
    }
}
