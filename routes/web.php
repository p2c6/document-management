<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\AccountCreated;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);
Route::get('/send-email', [TestController::class, 'sendEmail']);
