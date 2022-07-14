<?php
namespace Ant\Shopee;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Ant\Shopee\Providers\EventServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->register(EventServiceProvider::class);
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