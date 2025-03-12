<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('de');
        !setlocale(LC_TIME, "de_DE.UTF8") &&
        !setlocale(LC_TIME, "de_DE.UTF-8") &&
        !setlocale(LC_TIME, "German.UTF-8");
    }
}
