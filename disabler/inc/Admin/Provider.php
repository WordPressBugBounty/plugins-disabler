<?php

namespace HBP\Disabler\Admin;

use HBP_Disabler_Vendor\Hybrid\Core\ServiceProvider;

/**
 * Plugin service provider.
 */
class Provider extends ServiceProvider {
    /**
     * Register.
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function register() {
        $this->app->singleton( \HBP\Disabler\Admin\OptionsPage::class );
        $this->app->singleton( \HBP\Disabler\Admin\PluginsPage::class );
    }

    /**
     * Boot.
     *
     * @return void
     */
    public function boot() {
        $this->app->resolve( \HBP\Disabler\Admin\OptionsPage::class )->boot();
        $this->app->resolve( \HBP\Disabler\Admin\PluginsPage::class )->boot();
    }
}
