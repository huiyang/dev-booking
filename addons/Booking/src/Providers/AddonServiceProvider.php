<?php

namespace Addons\Booking\Providers;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    /**
     * Register any addon services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Bootstrap any addon services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (class_exists(\Addons\User\Facades\UserPage::class)) {
            // \Addons\User\Facades\UserPage::registerTab('Bookings', 'user-Bookings');
        }
        \Fusion::asset('/addons/Booking/js/app.js');
        fieldtypes()->register(\Addons\Booking\Fieldtypes\BookingFieldtype::class);
    }
}