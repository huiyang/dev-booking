<?php

namespace Addons\User\Providers;

use Illuminate\Support\ServiceProvider;
use Fusion\Providers\AddonServiceProvider as BaseAddonServiceProvider;

class AddonServiceProvider extends BaseAddonServiceProvider
{
    protected $navigation = [
        'title' => 'User',
        'to'    => '/quotes',
        'icon'  => 'quote-right'
    ];

    /**
     * Register any addon services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
        
        $this->app->singleton('user-list', function() {
            return new \Addons\User\Managers\UserPage;
        });

        // We do this in register() to make sure it is always the first tab.
        \Addons\User\Facades\UserPage::registerTab('Profile', 'user-list-profile');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any addon services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Fusion::asset('/addons/User/js/app.js');
    }
}