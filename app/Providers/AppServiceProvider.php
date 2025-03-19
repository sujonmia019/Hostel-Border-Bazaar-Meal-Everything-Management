<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function(){
            return auth()->user()->role == 1;
        });

        Gate::define('hostel-admin', function(){
            return auth()->user()->role == 2;
        });

        Gate::define('border', function(){
            return auth()->user()->role == 3;
        });

        View::composer('*', function ($view) {
            if (auth()->check()) {
                $user = auth()->user()->username;
                $view->with('username', $user);
            }
        });
    }
}
