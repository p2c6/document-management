<?php

namespace App\Providers;

use App\Models\Documents;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Node\Block\Document;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define('create-role', function (User $user) {
        //     return $user->role_id == 1;
        // });
    }
}
