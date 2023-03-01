<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Contracts\UserRepoContract; 
use App\Repository\UserRepo;  


class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepoContract::class , UserRepo::class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
