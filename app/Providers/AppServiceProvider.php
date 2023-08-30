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
        //User
        $this->app->bind('App\Contracts\Services\UserServiceInterface', 'App\Services\UserService');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface', 'App\Dao\UserDao');

        //Post
        $this->app->bind('App\Contracts\Services\PostServiceInterface', 'App\Services\PostService');
        $this->app->bind('App\Contracts\Dao\PostDaoInterface', 'App\Dao\PostDao');

        //Auth
        $this->app->bind('App\Contracts\Services\AuthServiceInterface', 'App\Services\AuthService');

        //Admin
        $this->app->bind('App\Contracts\Services\AdminServiceInterface', 'App\Services\AdminService');

        //Comment
        $this->app->bind('App\Contracts\Services\CommentServiceInterface', 'App\Services\CommentService');
        $this->app->bind('App\Contracts\Dao\CommentDaoInterface', 'App\Dao\CommentDao');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
