<?php

namespace Addons\Booking\Providers;

use Illuminate\Support\ServiceProvider;
use Fusion\Facades\Menu;

class AddonServiceProvider extends \Fusion\Providers\AddonServiceProvider
{
    protected $navigation = [
        'title' => 'Booking',
        'to'    => '/booking',
        'icon'  => 'grip-horizontal',
    ];

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
        parent::boot();

        $this->registerBookableMatricesMenu();

        $this->bootAdminMenu();

        //
        if (class_exists(\Addons\User\Facades\UserPage::class)) {
            // \Addons\User\Facades\UserPage::registerTab('Bookings', 'user-Bookings');
        }
        \Fusion::asset('/addons/Booking/js/app.js');
        fieldtypes()->register(\Addons\Booking\Fieldtypes\BookingFieldtype::class);
    }

    protected function registerBookableMatricesMenu()
    {
        $bookingMatrices = \Fusion\Models\Matrix::whereHas('blueprint', function($q) {  
            $q->whereHas('fields', function($q) {  
                $q->where('type', 'booking');  
            });
        })->get();

        $this->navigation['children'] = $bookingMatrices->map(function($matrix) {
            return [
                'title' => $matrix->name,
                'to' => '/bookable-collection/'.$matrix->slug,
            ];
        });
    }

    protected function bootAdminMenu()
    {
        $slug = 'booking';

        if (!Menu::has("admin.{$slug}")) {
            Menu::set('admin.addons', [
                'title'   => 'Addons',
                'divider' => true,
            ]);
        }

        Menu::set("admin.{$slug}", $this->navigation);
    }
}