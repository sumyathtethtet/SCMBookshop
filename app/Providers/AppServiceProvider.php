<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Contracts\Services\UserServiceInterface','App\Services\UserService');
        $this->app->bind('App\Contracts\Dao\UserDaoInterface','App\Dao\UserDao');

        $this->app->bind('App\Contracts\Services\AuthorServiceInterface','App\Services\AuthorService');
        $this->app->bind('App\Contracts\Dao\AuthorDaoInterface','App\Dao\AuthorDao');

        $this->app->bind('App\Contracts\Services\GenreServiceInterface','App\Services\GenreService');
        $this->app->bind('App\Contracts\Dao\GenreDaoInterface','App\Dao\GenreDao');
    }
}
