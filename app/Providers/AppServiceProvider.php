<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Services\UserServiceInterface','App\Services\UserService');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface','App\Dao\UserDao');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
