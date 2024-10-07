<?php

/**
 * Helper functions.
 *
 * Helpers are functions designed for quickly accessing data from the container
 * that we need throughout the framework.
 *
 * @package   HybridCore
 * @link      https://github.com/themehybrid/hybrid-core
 *
 * @author    Theme Hybrid
 * @copyright Copyright (c) 2008 - 2023, Theme Hybrid
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
namespace HBP_Disabler_Vendor\Hybrid;

use HBP_Disabler_Vendor\Hybrid\Container\Container;
use HBP_Disabler_Vendor\Hybrid\Core\Mix;
if (!function_exists(__NAMESPACE__ . '\app')) {
    /**
     * Get the available container instance.
     *
     * @param  string|null $abstract
     * @param  array       $parameters
     * @return mixed|\Hybrid\Contracts\Core\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }
        return Container::getInstance()->make($abstract, $parameters);
    }
}
if (!function_exists(__NAMESPACE__ . '\app_path')) {
    /**
     * Get the path to the application folder.
     *
     * @param  string $path
     * @return string
     */
    function app_path($path = '')
    {
        return app()->path($path);
    }
}
if (!function_exists(__NAMESPACE__ . '\booted')) {
    /**
     * Conditional function for checking whether the application has been
     * booted. Use before launching a new application. If booted, reference
     * the `app()` instance directly.
     *
     * @return bool
     */
    function booted()
    {
        return defined('HBP_Disabler_Vendor\HYBRID_CORE_BOOTED') && \true === HYBRID_CORE_BOOTED;
    }
}
if (!function_exists(__NAMESPACE__ . '\path')) {
    /**
     * Returns the directory path of the framework. If a file is passed in,
     * it'll be appended to the end of the path.
     *
     * @param  string $file
     * @return string
     */
    function path($file = '')
    {
        $file = ltrim($file, '/');
        return $file ? App::resolve('path') . "/{$file}" : App::resolve('path');
    }
}
if (!function_exists(__NAMESPACE__ . '\version')) {
    /**
     * Returns the framework version.
     *
     * @return string
     */
    function version()
    {
        return App::resolve('version');
    }
}
if (!function_exists('HBP_Disabler_Vendor\event')) {
    /**
     * Dispatch an event and call the listeners.
     *
     * @param  string|object $event
     * @param  mixed         $payload
     * @param  bool          $halt
     * @return array|null
     */
    function event(...$args)
    {
        return app('events')->dispatch(...$args);
    }
}
if (!function_exists(__NAMESPACE__ . '\base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string $path
     * @return string
     */
    function base_path($path = '')
    {
        return app()->basePath($path);
    }
}
if (!function_exists(__NAMESPACE__ . '\config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null $key
     * @param  mixed             $default
     * @return mixed|\Hybrid\Tools\Config\Repository
     */
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }
        if (is_array($key)) {
            return app('config')->set($key);
        }
        return app('config')->get($key, $default);
    }
}
if (!function_exists(__NAMESPACE__ . '\config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->configPath($path);
    }
}
if (!function_exists(__NAMESPACE__ . '\mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string $path
     * @param  string $manifestDirectory
     * @return \Hybrid\Tools\HtmlString|string
     * @throws \Exception
     */
    function mix($path, $manifestDirectory = '')
    {
        return app(Mix::class)(...func_get_args());
    }
}
if (!function_exists(__NAMESPACE__ . '\public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string $path
     * @return string
     */
    function public_path($path = '')
    {
        return app()->publicPath($path);
    }
}
if (!function_exists(__NAMESPACE__ . '\resolve')) {
    /**
     * Resolve a service from the container.
     *
     * @param  string $name
     * @param  array  $parameters
     * @return mixed
     */
    function resolve($name, array $parameters = [])
    {
        return app($name, $parameters);
    }
}
if (!function_exists(__NAMESPACE__ . '\resource_path')) {
    /**
     * Get the path to the resources folder.
     *
     * @param  string $path
     * @return string
     */
    function resource_path($path = '')
    {
        return app()->resourcePath($path);
    }
}
if (!function_exists(__NAMESPACE__ . '\storage_path')) {
    /**
     * Get the path to the storage folder.
     *
     * @param  string $path
     * @return string
     */
    function storage_path($path = '')
    {
        return app()->storagePath($path);
    }
}
