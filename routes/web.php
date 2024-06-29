<?php

use App\Http\Controllers\TestController;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    SendEmailJob::dispatch();
    return view('welcome');
});

Route::get('/test', [TestController::class]);
