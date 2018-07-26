<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class yugi_provider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\YugiRepository', function($app) {
            return new \App\Repositories\YugiRepository(\DB::connection('hop'));
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
