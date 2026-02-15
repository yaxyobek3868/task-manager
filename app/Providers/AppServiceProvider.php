<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\Contract\AuthContract;
use App\Services\Contract\TaskContract;
use App\Services\Contract\TaskHistoryContract;
use App\Services\Contract\UserContract;
use App\Services\TaskHistoryService;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthContract::class, AuthService::class);
        $this->app->singleton(TaskContract::class, TaskService::class);
        $this->app->singleton(TaskHistoryContract::class, TaskHistoryService::class);
        $this->app->singleton(UserContract::class, UserService::class);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
