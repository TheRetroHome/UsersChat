<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->is_admin;
        });

        Blade::if('candelete', function ($message) {
            return auth::check() && (auth()->user()->is_admin || auth()->id() == $message->user_id);
        });

        Blade::if('prefix', function ($message) {
            return $message->user->is_admin;
        });
    }
}
