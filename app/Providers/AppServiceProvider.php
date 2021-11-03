<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Schema;

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
        Schema::defaultStringLength(191);

        date_default_timezone_set('Europe/Warsaw');
        setlocale(LC_ALL, 'pl_PL.utf8');
    }
}
