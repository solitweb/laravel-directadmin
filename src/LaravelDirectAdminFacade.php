<?php

namespace Solitweb\LaravelDirectAdmin;

use Illuminate\Support\Facades\Facade;

class LaravelDirectAdminFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'laravel-directadmin';
    }
}