<?php

namespace Api\V1_0_0\Providers;

use Illuminate\Support\ServiceProvider;
class BackEndServiceProvider extends ServiceProvider
{
    protected $version = 'V1_0_0';
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Api'.'\\'.$this->version.'\\'.'Repositories\User\UserInterface',
            'Api'.'\\'.$this->version.'\\'.'Repositories\User\UserRepository'
        );
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
