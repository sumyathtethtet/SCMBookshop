<?php

namespace laravel\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use Log;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Debug log for SQL
    DB::listen(
      function ($sql) {
        foreach ($sql->bindings as $i => $binding) {
          if ($binding instanceof \DateTime) {
            $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
          } else {
            if (is_string($binding)) {
              $sql->bindings[$i] = "'$binding'";
            }
          }
        }
        // Insert bindings into query
        $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);
        $query = vsprintf($query, $sql->bindings);
        Log::debug($query);
      }
    );
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    // Dao Registration
    $this->app->bind('laravel\Contracts\Dao\Auth\AuthDaoInterface', 'laravel\Dao\Auth\AuthDao');
    $this->app->bind('laravel\Contracts\Dao\User\UserDaoInterface', 'laravel\Dao\User\UserDao');

    // Business logic registration
    $this->app->bind('laravel\Contracts\Services\Auth\AuthServiceInterface', 'laravel\Services\Auth\AuthService');
    $this->app->bind('laravel\Contracts\Services\User\UserServiceInterface', 'laravel\Services\User\UserService');
  }
}
