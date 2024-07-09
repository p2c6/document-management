<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use P2c6\LaravelSystemGeneratedCode\Helpers\SystemGeneratedCodeHelper;

class TestController extends Controller
{
    public function generateCode()
    {
        $generatedCode = SystemGeneratedCodeHelper::generateCode(123);
        return $generatedCode;
    }
    
    public function test()
    {
        $user = User::all();
     
        // Collection::macro('toUpper', function () {
        //     return $this->map(function (string $value) {
        //         return Str::upper($value);
        //     });
        // });
        
        // $average = collect($user)->sum('id');;

        // return $average;

        $test = collect($user)
        ->filter(fn($user) => $user->active)
        ->map(fn($user) => $user->name)
        ->sort()
        ->all();

        return $test;
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
