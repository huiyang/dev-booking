<?php

namespace Addons\Subscription\Providers;

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
            \Addons\User\Facades\UserPage::registerTab('Subscriptions', 'user-subscriptions');
        }
        \Fusion::asset('/addons/Subscription/js/app.js');
    }
}