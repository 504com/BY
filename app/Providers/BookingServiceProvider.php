<?php

namespace App\Providers;

use App\Services\Booking\BookingOnWeek;
use App\Services\Booking\BookingOnWeekend;
use App\Services\Booking\BookingStrategy;
use Illuminate\Support\ServiceProvider;

class BookingServiceProvider extends ServiceProvider
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
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookingStrategy::class, function ($app, $params) {
            return $params['date']->dayOfWeek >= 0 && $params['date']->dayOfWeek < 5
                ? new BookingOnWeek()
                : new BookingOnWeekend();
        });
    }
}
