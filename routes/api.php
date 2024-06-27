<?php

use App\Http\Controllers\API\v1\Admin\RoleController;
use App\Http\Controllers\API\v1\Authentication\AuthController;
use App\Http\Controllers\API\v1\Documents\ApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['web'])->prefix('v1/')->name('api.v1.')->group(function() {
    //ROLES
    Route::prefix('roles')->name('roles.')->group(function() {
        Route::controller(RoleController::class)->group(function() {
            Route::post('store', 'store');
        });
    });

    //AUTHENTICATION
    Route::prefix('auth')->name('auth.')->group(function() {
        Route::controller(AuthController::class)->group(function() {
            Route::post('signup', 'signup')->name('signup');
            Route::post('signin', 'signin')->name('signin');
            Route::post('signout', 'signout')->name('signout');
        });
    });

    //APPLICATION
    Route::prefix('application')->name('application.')->group(function() {
        Route::controller(ApplicationController::class)->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::post('store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
        });
    });
    
    //CSRF
    Route::get('/csrf-token', function () {
        return response()->json(['csrf_token' => csrf_token()]);
    });
});



