<?php

use App\Http\Controllers\API\v1\Admin\RoleController;
use App\Http\Controllers\API\v1\Authentication\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/')->name('api.v1.')->group(function() {
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
        });
    });

});
