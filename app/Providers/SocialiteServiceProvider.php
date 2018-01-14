<?php

namespace App\Providers;


use App\Services\Socialite\SocialiteManager;

class SocialiteServiceProvider extends \Laravel\Socialite\SocialiteServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Laravel\Socialite\Contracts\Factory', function($app)
        {
            return new SocialiteManager($app);
        });
    }
}
