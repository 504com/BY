<?php

namespace App\Providers;

use App\Services\Booking;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'fr_FR.UTF-8');

		Validator::extend('old_password', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Booking::class, function($app, $params)
        {
            return new Booking($params['date']);
        });
    }
}
