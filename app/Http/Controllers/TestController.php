<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;

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

    public function sendEmail()
    {
        $data = ['message' => 'test'];
        $email = 'jdoe1@gmail.com';
    //     Mail::send('mail.authentication.signup', $data,  function($message) use ($email) {
    //         $message->from('ggsir@gmail.com','Test'); 
    //         $message->to($email)->subject('Account Created');
    //    });

        Mail::to($email)->send(new AccountCreated());
        return 'Email sent...';
    }
}
