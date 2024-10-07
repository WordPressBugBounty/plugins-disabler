<?php

namespace HBP\Disabler\Optimize;

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
        $this->app->singleton( \HBP\Disabler\Optimize\Editor::class );
        $this->app->singleton( \HBP\Disabler\Optimize\Backend::class );
        $this->app->singleton( \HBP\Disabler\Optimize\Frontend::class );
        $this->app->singleton( \HBP\Disabler\Optimize\Privacy::class );
        $this->app->singleton( \HBP\Disabler\Optimize\Revisions::class );
        $this->app->singleton( \HBP\Disabler\Optimize\XMLRPC::class );
        $this->app->singleton( \HBP\Disabler\Optimize\Performance::class );
        $this->app->singleton( \HBP\Disabler\Optimize\RestAPI::class );
        $this->app->singleton( \HBP\Disabler\Optimize\Feeds::class );
        $this->app->singleton( \HBP\Disabler\Optimize\Updates::class );
    }

    /**
     * Boot.
     *
     * @return void
     */
    public function boot() {
        $this->app->resolve( \HBP\Disabler\Optimize\Editor::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\Backend::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\Frontend::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\Privacy::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\Revisions::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\XMLRPC::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\Performance::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\RestAPI::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\Feeds::class )->boot();
        $this->app->resolve( \HBP\Disabler\Optimize\Updates::class )->boot();
    }
}
