<?php

namespace HBP_Disabler_Vendor\Hybrid\Events;

use function HBP_Disabler_Vendor\Hybrid\app;
if (!function_exists(__NAMESPACE__ . '\event')) {
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
