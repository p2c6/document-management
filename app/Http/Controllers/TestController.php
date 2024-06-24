<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Application;

class TestController extends Controller
{
    public function test()
    {
        // Mocking paginated data (you may adjust this depending on your actual data structure)
        $paginatedData = [
            ['id' => 1, 'name' => 'Application 1'],
            ['id' => 2, 'name' => 'Application 2'],
            // Add more data as needed
        ];
        
        // Mocking the Application::paginate() method to return $paginatedData
        $mockApplication = $this->getMockBuilder(Application::class)
                                ->getMock();
        
        $mockApplication->method('paginate')
                        ->willReturn($paginatedData);

       info($mockApplication);
    }
}
