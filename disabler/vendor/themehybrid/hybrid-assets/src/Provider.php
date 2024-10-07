<?php

namespace HBP_Disabler_Vendor\Hybrid\Assets;

use HBP_Disabler_Vendor\Hybrid\Core\ServiceProvider;
/**
 * Assets provider class.
 */
class Provider extends ServiceProvider
{
    /**
     * Register.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ParentTheme::class);
        $this->app->singleton(ChildTheme::class);
        $this->app->singleton(Plugin::class);
    }
}
