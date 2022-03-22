<?php
namespace Addons\User\Facades;

use Illuminate\Support\Facades\Facade;

class UserPage extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user-list';
    }
}