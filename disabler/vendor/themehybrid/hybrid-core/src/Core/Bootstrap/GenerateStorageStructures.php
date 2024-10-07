<?php

namespace HBP_Disabler_Vendor\Hybrid\Core\Bootstrap;

use HBP_Disabler_Vendor\Hybrid\Contracts\Core\Application;
use HBP_Disabler_Vendor\Hybrid\Filesystem\Filesystem;
class GenerateStorageStructures
{
    /**
     * Bootstrap the given application.
     *
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $directories = [$app->storagePath(), $app->getCachedServicesPath(), $app->getCachedPackagesPath(), $app->getCachedConfigPath(), $app->getCachedEventsPath()];
        foreach ($directories as $directory) {
            $directory = dirname($directory);
            if ((new Filesystem())->exists($directory)) {
                continue;
            }
            (new Filesystem())->ensureDirectoryExists($directory);
        }
    }
}
