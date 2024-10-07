<?php

/**
 * Action scheduler service provider.
 */
namespace HBP_Disabler_Vendor\Hybrid\Action\Scheduler;

use HBP_Disabler_Vendor\Hybrid\Core\ServiceProvider;
/**
 * Action Scheduler provider class.
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
        $this->app->singleton('hybrid/queue', static fn($container) => new Queue());
    }
}
