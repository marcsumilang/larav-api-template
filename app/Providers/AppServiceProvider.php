<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Api\V1_0_0\Providers\BackEndServiceProvider as V1_0_0;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       (new V1_0_0($this->app))->register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
