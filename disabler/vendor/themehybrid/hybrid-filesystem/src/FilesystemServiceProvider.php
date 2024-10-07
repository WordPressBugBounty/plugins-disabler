<?php

namespace HBP_Disabler_Vendor\Hybrid\Filesystem;

use HBP_Disabler_Vendor\Hybrid\Core\ServiceProvider;
class FilesystemServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerNativeFilesystem();
        $this->registerFlysystem();
    }
    /**
     * Register the native filesystem implementation.
     *
     * @return void
     */
    protected function registerNativeFilesystem()
    {
        $this->app->singleton('files', static fn() => new Filesystem());
    }
    /**
     * Register the driver based filesystem.
     *
     * @return void
     */
    protected function registerFlysystem()
    {
        $this->registerManager();
        $this->app->singleton('filesystem.disk', fn($app) => $app['filesystem']->disk($this->getDefaultDriver()));
        $this->app->singleton('filesystem.cloud', fn($app) => $app['filesystem']->disk($this->getCloudDriver()));
    }
    /**
     * Register the filesystem manager.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('filesystem', static fn($app) => new FilesystemManager($app));
    }
    /**
     * Get the default file driver.
     *
     * @return string
     */
    protected function getDefaultDriver()
    {
        return $this->app['config']['filesystems.default'];
    }
    /**
     * Get the default cloud based file driver.
     *
     * @return string
     */
    protected function getCloudDriver()
    {
        return $this->app['config']['filesystems.cloud'];
    }
}
