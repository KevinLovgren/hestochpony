<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class YugiProvider extends ServiceProvider
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

        parent::boot()
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
