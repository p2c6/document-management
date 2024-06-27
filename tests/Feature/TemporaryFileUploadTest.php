<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TemporaryFileUploadTest extends TestCase
{
    /**
     * Test temporary file single upload via API.
     * 
     *  This test verifies that a user can be upload a temporary single file successfully via the API endpoint.
     */
    public function test_temporary_file_single_upload_via_api(): void
    {
        $csrfToken = csrf_token();

        Storage::fake('public'); // Use a fake disk for testing

        $file = UploadedFile::fake()->create('testfile.txt'); // Create a fake uploaded file

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken
        ])->postJson('/api/v1/temporary-file/upload', [
            'filepond' => $file,
        ]);

        $response->assertStatus(200); // Assuming 200 is the success status code
        $this->assertNotEquals('', $response->content());

        // Optionally assert the created temporary files in the database
        $this->assertDatabaseHas('temporary_files', [
            'folder' => $response->content(), // Assuming you store hash name
        ]);
    }

    /**
     * Test temporary file multiple upload via API.
     * 
     *  This test verifies that a user can be upload a temporary multiple file successfully via the API endpoint.
     */
    public function test_temporary_file_multiple_upload_via_api(): void
    {
        $csrfToken = csrf_token();

        Storage::fake('public'); // Use a fake disk for testing

        $fileOne = UploadedFile::fake()->create('testfile.txt'); // Create a fake uploaded file
        $fileTwo = UploadedFile::fake()->create('testfile2.txt'); // Create a fake uploaded file

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => $csrfToken
        ])->postJson('/api/v1/temporary-file/upload', [
            'filepond' => [
                $fileOne,
                $fileTwo,
            ]
        ]);

        $response->assertStatus(200); // Assuming 200 is the success status code

        $responseData = $response->json();

        foreach($responseData as $responseData) {
            $this->assertDatabaseHas('temporary_files', [
                'folder' => $responseData, 
            ]);
        }
        
        $this->assertNotEquals('', $response->content());
    }
}
