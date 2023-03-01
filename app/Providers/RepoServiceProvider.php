<?php

namespace App\Providers;

use App\Repository\CategoryRepo;
use App\Repository\TaskRepo;
use App\Repository\Contracts\CategoryRepoContract;
use App\Repository\Contracts\TaskRepoContract;
use Illuminate\Support\ServiceProvider;
use App\Repository\Contracts\UserRepoContract; 
use App\Repository\UserRepo;  


class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepoContract::class , UserRepo::class); 
        $this->app->bind(CategoryRepoContract::class , CategoryRepo::class); 
        $this->app->bind(TaskRepoContract::class , TaskRepo::class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
