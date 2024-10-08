<?php

namespace HBP_Disabler_Vendor\Hybrid\Tools\Facades;

use HBP_Disabler_Vendor\Hybrid\Core\Facades\Facade;
/**
 * @see \Hybrid\Tools\Config\Repository
 *
 * @method static bool has(string $key)
 * @method static mixed get(array|string $key, mixed $default = null)
 * @method static array getMany(array $keys)
 * @method static void set(array|string $key, mixed $value = null)
 * @method static void prepend(string $key, mixed $value)
 * @method static void push(string $key, mixed $value)
 * @method static array all()
 * @method static void macro(string $name, object|callable $macro)
 * @method static void mixin(object $mixin, bool $replace = true)
 * @method static bool hasMacro(string $name)
 * @method static void flushMacros()
 */
class Config extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'config';
    }
}
