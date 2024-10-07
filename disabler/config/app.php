<?php

namespace HBP_Disabler_Vendor;

use HBP_Disabler_Vendor\Hybrid\Core\Facades\Facade;
use HBP_Disabler_Vendor\Hybrid\Core\ServiceProvider;
use function HBP_Disabler_Vendor\Hybrid\Tools\env;

return [
    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */
    'providers' => ServiceProvider::defaultProviders()->merge( [] )->toArray(),
    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */
    'aliases' => Facade::defaultAliases()->merge( [] )->toArray(),
    'debug'   => (bool) env( 'APP_DEBUG', static fn() => \defined( 'WP_DEBUG' ) && \WP_DEBUG ),
    'env'     => env( 'APP_ENV', static function () {
        $env = 'development';
        if ( \function_exists( 'wp_get_environment_type' ) ) {
            $env = \wp_get_environment_type();
            $env = ( 'local' === $env ) ? 'development' : $env;
        }

        return $env;
    } ),
];
