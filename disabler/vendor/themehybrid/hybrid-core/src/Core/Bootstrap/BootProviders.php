<?php

namespace HBP_Disabler_Vendor\Hybrid\Core\Bootstrap;

use HBP_Disabler_Vendor\Hybrid\Contracts\Core\Application;
class BootProviders
{
    /**
     * Bootstrap the given application.
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $app->boot();
    }
}
