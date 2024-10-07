<?php

/**
 * Helper functions.
 */
namespace HBP_Disabler_Vendor\Hybrid\Action\Scheduler;

use function HBP_Disabler_Vendor\Hybrid\app;
function queue()
{
    return app('hybrid/queue');
}
